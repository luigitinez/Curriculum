
    var elems = document.getElementsByClassName('btn-danger');
    var confirmIt = function (e) {
        if (!confirm('¿Está seguro de que desea borrar el registro?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
