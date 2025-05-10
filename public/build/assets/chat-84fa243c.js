console.log("Chat.js loaded - Setting up realtime chat");window.Echo.channel("chat-channel").listen("message-sent",e=>{console.log("New chat message received:",e);const t=window.currentUserId||"";e.receiverId==t?(console.log(`This message is for user ${t}`),window.location.href.includes("/admin/")?i(e):o(e)):console.log(`Message not for current user. Target: ${e.receiverId}, Current: ${t}`)});function o(e){if(!$(".fp__chat_body").length){console.log("Chat body not found in frontend");return}console.log("Handling message in frontend");let t=`<div class="fp__chating">
        <div class="fp__chating_img">
            <img src="${e.avatar}" class="img-fluid w-100" style="border-radius: 50%;">
        </div>
        <div class="fp__chating_text">
            <p>${e.message}</p>
        </div>
    </div>`;$(".fp__chat_body").append(t),n(".fp__chat_body"),$(".sunseen-message-count").text(1)}function i(e){if(console.log("Handling message in admin"),e.senderId==$("#mychatbox").attr("data-inbox")){let t=`
            <div class="chat-item chat-left">
                <img style="width:50px;height:50px;object-fit:cover;" src="${e.avatar}">
                <div class="chat-details">
                    <div class="chat-text">${e.message}</div>
                    <div class="chat-time">just now</div>
                </div>
            </div>
        `;$("#mychatbox").find(".chat-content").append(t),n("#mychatbox .chat-content")}$(".fp_chat_user").each(function(){let t=$(this).data("user");if(e.senderId==t){let s='<i class="beep"></i>new message';$(this).find(".got_new_message").html(s)}}),$(".message-envelope").addClass("beep")}function n(e){let t=$(e);t.length&&t.scrollTop(t.prop("scrollHeight"))}document.addEventListener("DOMContentLoaded",function(){window.currentUserId=document.body.getAttribute("data-user-id")||"",console.log(`Current user ID set to: ${window.currentUserId}`),window.location.href.includes("/admin/")&&$("#chat-form").on("submit",function(){console.log("Chat.js: Send handler attached")})});
