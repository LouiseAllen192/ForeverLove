
var theSubmitButton = document.getElementById('Send');

theSubmitButton.onclick = function() {
        var theFormItself = document.getElementById('accTypeForm');
        theFormItself.style.display = 'none';
        var theSuccessMessage = document.getElementById('selectedMessage');
        theSuccessMessage.style.display = 'block';
    }
