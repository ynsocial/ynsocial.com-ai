(function () {
    'use strict'

    let checkAll = document.querySelector('.check-all');

    if (checkAll) {
        checkAll.addEventListener('click', checkAllFn);
    }

    function checkAllFn() {
        if (checkAll.checked) {
            document.querySelectorAll('.product-checkbox input').forEach(function (e) {
                e.closest('.product-list').classList.add('selected');
                e.checked = true;
            });

        }
        else {
            document.querySelectorAll('.product-checkbox input').forEach(function (e) {
                e.closest('.product-list').classList.remove('selected');
                e.checked = false;
            });
        }

        getCheckeds();
    }

    $('.product-list .form-check-input').on('change', function() {
        getCheckeds();
    });

    function getCheckeds(){

        var selectedValues = $('.product-list .form-check-input:checked').map(function() {
            return $(this).val();
        }).get();

        if(selectedValues.length > 0){
            $('.bulk-delete').attr("href", $('.bulk-delete').attr("data-url")+"?ids="+selectedValues);
            $('.bulk-delete').show();
        }else{
            $('.bulk-delete').attr("href", "javascript:void(0);");
            $('.bulk-delete').hide();
        }


        return selectedValues;
    }

    $('.bulk-delete').click(function (e){
        e.preventDefault();
        var thisButtonHref = $('.bulk-delete').attr("href");

        Swal.fire({
            title: 'Seçilen içerikleri silmek istediğine emin misin?',
            text: "Silinen içerikler daha sonrasında geri alınamaz.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = thisButtonHref;
            }
        })
    });

})();
