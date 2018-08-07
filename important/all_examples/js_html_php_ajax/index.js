$(document).ready(function(){

    function fun1(){
        $('.result').text('Ожидаем отправки данных...');
    }

    function fun2(data){
        $('.result').html(data);
    }

    $('#button').on('click', function () {
        let name = $('#name').val();
        let age = $('#age').val();

        $.ajax({
            url: 'php.php',
            type: 'POST',
            data: ({name: name, age: age}),
            dataType: 'html',
            beforeSend: fun1,
            success: fun2
        });
    });
});