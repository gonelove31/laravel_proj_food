import re
import json
import base64
import os
import random

def gen_id():
    # Sinh id ngắn, đủ unique cho StarUML (không cần quá dài)
    return base64.b64encode(os.urandom(8)).decode('utf-8')

with open('food_park.sql', encoding='utf-8') as f:
    sql = f.read()

tables = re.findall(r'CREATE TABLE \[(\w+)\] \((.*?)\);', sql, re.S)

class_elements = []
class_ids = {}

for table, body in tables:
    class_id = gen_id()
    class_ids[table] = class_id
    attributes = []
    columns = re.findall(r'\[(\w+)\]\s+([\w\(\)]+)', body)
    for col, typ in columns:
        attributes.append({
            "_id": gen_id(),
            "_type": "UMLAttribute",
            "name": col,
            "type": typ
        })
    # Thêm các method them/sua/xoa cho mọi bảng
    methods = []
    for op in ["them", "sua", "xoa"]:
        methods.append({
            "_id": gen_id(),
            "_type": "UMLOperation",
            "name": op
        })
    class_elements.append({
        "_id": class_id,
        "_type": "UMLClass",
        "name": table,
        "attributes": attributes,
        "operations": methods
    })

# Optional: Tạo diagram để khi import vào có luôn sơ đồ
diagram_id = gen_id()
diagram_elements = []
for idx, c in enumerate(class_elements):
    diagram_elements.append({
        "_id": gen_id(),
        "_type": "UMLClassView",
        "model": c["_id"],
        "left": 100 + (idx % 5) * 300,
        "top": 100 + (idx // 5) * 200
    })

diagram = {
    "_id": diagram_id,
    "_type": "UMLClassDiagram",
    "name": "FoodPark Diagram",
    "ownedViews": diagram_elements
}

# Gói vào fragment
fragment = {
    "_type": "UMLModel",
    "_id": gen_id(),
    "name": "FoodPark",
    "ownedElements": class_elements + [diagram]
}

with open('food_park_fragment.mfj', 'w', encoding='utf-8') as f:
    json.dump(fragment, f, ensure_ascii=False, indent=2)