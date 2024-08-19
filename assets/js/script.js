function switchForm() {
    const type = document.getElementById('productType').value;
    const dynamicForm = document.getElementById('dynamicForm');
    let html = '';

    switch(type) {
        case 'DVD':
            html = `
                <label for="size">Size (MB):</label>
                <input type="text" id="size" name="size" required>
                <p>Please, provide size in MB.</p>
            `;
            break;
        case 'Furniture':
            html = `
                <label for="height">Height (CM):</label>
                <input type="text" id="height" name="height" required>
                <label for="width">Width (CM):</label>
                <input type="text" id="width" name="width" required>
                <label for="length">Length (CM):</label>
                <input type="text" id="length" name="length" required>
                <p>Please, provide dimensions in HxWxL format.</p>
            `;
            break;
        case 'Book':
            html = `
                <label for="weight">Weight (KG):</label>
                <input type="text" id="weight" name="weight" required>
                <p>Please, provide weight in KG.</p>
            `;
            break;
    }

    dynamicForm.innerHTML = html;
}

document.getElementById('product_form').onsubmit = function(event) {
    const sku = document.getElementById('sku').value.trim();
    const name = document.getElementById('name').value.trim();
    const price = document.getElementById('price').value.trim();
    const type = document.getElementById('productType').value.trim();
    const dynamicFields = document.getElementById('dynamicForm').querySelectorAll('input');

    if (!sku || !name || !price || !type || Array.from(dynamicFields).some(field => !field.value.trim())) {
        event.preventDefault();
        document.getElementById('notification').innerText = "Please, submit required data";
        return;
    }
};

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("massDeleteForm").addEventListener("submit", function(event) {
        const checkboxes = document.querySelectorAll('.delete-checkbox:checked');
        if (checkboxes.length === 0) {
            event.preventDefault();
            alert('Please select at least one product to delete.');
        }
    });


    var errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {

        setTimeout(function () {
            errorAlert.style.opacity = 0;
            setTimeout(function () {
                errorAlert.style.display = 'none';
            }, 500);
        }, 3000);
    }
});
