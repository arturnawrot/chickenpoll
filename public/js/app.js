$(document).ready(function() {
    $("#form-poll-store").on("submit", function() {
        $('#options #option').each(function () {
            var input = $(this);

            if(!input.val()) {
                input.removeAttr('name');
            } else {
                input.prop('name', 'options[]');
            }
        });
    })
});

function add(element)
{
    let options = document.getElementById('options');
    var div = document.createElement('div');
    div.className = "form-group";
    var label = document.createElement('label');
    label.innerHTML = "Poll option";
    var input = document.createElement('input');
    input.placeholder = "Enter option";
    input.name = "options[]";
    input.className = "form-control";
    input.id = "option";
    div.onclick = function () {
        div.onclick = null;
        add(input);
    };
    div.appendChild(label);
    div.appendChild(input);
    options.appendChild(div);
    element.onclick = null;
}