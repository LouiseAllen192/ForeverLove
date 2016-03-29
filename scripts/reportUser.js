function filter(element){
    var input = document.getElementById(element);
    var pattern = /[^a-z 0-9.,!?\\\n/]/gi;
    input.value = input.value.replace(pattern, '');
}