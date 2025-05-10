// Chat.js - Xử lý chất realtime cho cả admin và frontend

// Thêm CSS cho typing indicator
const style = document.createElement('style');
style.textContent = `
    .typing-dots {
        display: inline-block;
        position: relative;
        width: 40px;
        height: 20px;
    }
    .typing-dots:after {
        content: '...';
        position: absolute;
        animation: typing 1.5s infinite;
    }
    @keyframes typing {
        0% { content: '.'; }
        33% { content: '..'; }
        66% { content: '...'; }
    }
`;
document.head.appendChild(style);

console.log("Chat.js loaded - Setting up realtime chat");

// Biến để theo dõi trạng thái typing
let typingTimeout = null;

// Lắng nghe sự kiện chat trên kênh chat-channel
window.Echo.channel('chat-channel')
    .listen('message-sent', (data) => {
        console.log("New chat message received:", data);
        console.log("Current user ID:", window.currentUserId);
        console.log("Message receiver ID:", data.receiverId);
        
        // Kiểm tra xem tin nhắn là cho user hiện tại không
        const currentUserId = window.currentUserId || '';
        
        if (data.receiverId == currentUserId) {
            console.log(`This message is for user ${currentUserId}`);
            
            // Xác định nếu đang ở trang admin hay frontend để xử lý tin nhắn
            if (window.location.href.includes('/admin/')) {
                console.log("Handling message in admin interface");
                handleAdminChatMessage(data);
            } else {
                console.log("Handling message in frontend interface");
                handleFrontendChatMessage(data);
            }
        } else {
            console.log(`Message not for current user. Target: ${data.receiverId}, Current: ${currentUserId}`);
        }
    })
    .listen('typing', (data) => {
        console.log("Typing event received:", data);
        const currentUserId = window.currentUserId || '';
        
        if (data.receiverId == currentUserId) {
            if (window.location.href.includes('/admin/')) {
                handleAdminTyping(data);
            } else {
                handleFrontendTyping(data);
            }
        }
    });

// Xử lý tin nhắn ở frontend
function handleFrontendChatMessage(data) {
    console.log("Frontend chat body selector:", $('.fp__chat_body').length);
    
    if (!$('.fp__chat_body').length) {
        console.log('Chat body not found in frontend');
        return;
    }
    
    // Xóa typing indicator nếu có
    $('.typing-indicator').remove();
    
    console.log("Handling message in frontend");
    
    let html = `<div class="fp__chating">
        <div class="fp__chating_img">
            <img src="${data.avatar}" class="img-fluid w-100" style="border-radius: 50%;">
        </div>
        <div class="fp__chating_text">
            <p>${data.message}</p>
        </div>
    </div>`;
    
    $('.fp__chat_body').append(html);
    scrollChatToBottom('.fp__chat_body');
    $('.sunseen-message-count').text(1);
}

// Xử lý tin nhắn ở admin
function handleAdminChatMessage(data) {
    console.log("Handling message in admin");
    console.log("Current chat inbox:", $('#mychatbox').attr('data-inbox'));
    console.log("Message sender ID:", data.senderId);
    
    // Xóa typing indicator nếu có
    $('.typing-indicator').remove();
    
    // Kiểm tra nếu đang chat với người gửi tin nhắn này
    if (data.senderId == $('#mychatbox').attr('data-inbox')) {
        console.log("Appending message to current chat");
        let html = `
            <div class="chat-item chat-left">
                <img style="width:50px;height:50px;object-fit:cover;" src="${data.avatar}">
                <div class="chat-details">
                    <div class="chat-text">${data.message}</div>
                    <div class="chat-time">just now</div>
                </div>
            </div>
        `;
        
        // Lựa chọn container chính xác để append tin nhắn
        $('#mychatbox').find('.chat-content').append(html);
        
        // Đảm bảo cuộn xuống dưới
        scrollChatToBottom('#mychatbox .chat-content');
    } else {
        console.log("Message not for current chat window");
    }
    
    // Hiển thị thông báo tin nhắn mới
    $(".fp_chat_user").each(function(){
        let senderId = $(this).data('user');
        if (data.senderId == senderId) {
            console.log("Updating notification for user:", senderId);
            let html = `<i class="beep"></i>new message`;
            $(this).find(".got_new_message").html(html);
        }
    });
    
    $('.message-envelope').addClass('beep');
}

// Xử lý typing indicator ở frontend
function handleFrontendTyping(data) {
    if (!$('.fp__chat_body').length) return;
    
    // Xóa typing indicator cũ nếu có
    $('.typing-indicator').remove();
    
    let html = `
        <div class="typing-indicator fp__chating">
            <div class="fp__chating_img">
                <img src="${data.avatar}" class="img-fluid w-100" style="border-radius: 50%;">
            </div>
            <div class="fp__chating_text">
                <p><span class="typing-dots">...</span></p>
            </div>
        </div>
    `;
    
    $('.fp__chat_body').append(html);
    scrollChatToBottom('.fp__chat_body');
    
    // Tự động xóa typing indicator sau 3 giây
    clearTimeout(typingTimeout);
    typingTimeout = setTimeout(() => {
        $('.typing-indicator').remove();
    }, 3000);
}

// Xử lý typing indicator ở admin
function handleAdminTyping(data) {
    if (data.senderId != $('#mychatbox').attr('data-inbox')) return;
    
    // Xóa typing indicator cũ nếu có
    $('.typing-indicator').remove();
    
    let html = `
        <div class="typing-indicator chat-item chat-left">
            <img style="width:50px;height:50px;object-fit:cover;" src="${data.avatar}">
            <div class="chat-details">
                <div class="chat-text"><span class="typing-dots">...</span></div>
            </div>
        </div>
    `;
    
    $('#mychatbox').find('.chat-content').append(html);
    scrollChatToBottom('#mychatbox .chat-content');
    
    // Tự động xóa typing indicator sau 3 giây
    clearTimeout(typingTimeout);
    typingTimeout = setTimeout(() => {
        $('.typing-indicator').remove();
    }, 3000);
}

// Cuộn chat xuống dưới cùng
function scrollChatToBottom(selector) {
    let chatContent = $(selector);
    if (chatContent.length) {
        chatContent.scrollTop(chatContent.prop("scrollHeight"));
    }
}

// Set user ID for global access
document.addEventListener('DOMContentLoaded', function() {
    window.currentUserId = document.body.getAttribute('data-user-id') || '';
    console.log(`Current user ID set to: ${window.currentUserId}`);
    
    // Gắn handler để xử lý status "sending..." khi gửi tin nhắn từ admin
    if (window.location.href.includes('/admin/')) {
        $('#chat-form').on('submit', function() {
            console.log('Chat.js: Send handler attached');
        });
    }
    
    // Thêm sự kiện typing cho input chat
    $('.chat-input').on('input', function() {
        const receiverId = $(this).data('receiver');
        if (!receiverId) return;
        
        // Gửi sự kiện typing
        window.Echo.channel('chat-channel').whisper('typing', {
            senderId: window.currentUserId,
            receiverId: receiverId,
            avatar: $('body').data('user-avatar') || '/frontend/images/user.jpg'
        });
    });
}); 