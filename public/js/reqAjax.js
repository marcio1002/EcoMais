$('document').ready(function (){
    
    $('#submit').click(() =>{
        let data = {
            name : $('#name').val(),
            email: $("#email").val(),
            pwd: $('#pwd').val()
        };
    
        $.post( "../controller/add.php",data,)
        .done((data) =>{
            alert("Cadastrado com sucesso!");
            console.log(data);
        })
        .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`))
    });

    $('#btnDltImage').click(function (){
        if(!confirm("Deseja realmente deletar!")) return;
        const data = { image: $('#image').val() };

        $.post("../controller/deleteImage.php", data,)
        .done((data) =>{
            alert('Deletado com sucesso!');
            const href = $(this ).attr('../view/mostrar.php','href');
            $('#boxImg').load(href);
            console.log(data);
        })
        .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`))
    })
    $("#btnUpdate").click(function (){
        const data = {
            name: $('name').val(),
            email: $('email').val(),
            passwd: $('pwd').val(),
        }
        $.post("../controller/update.php", data,)
        .done((data) =>{
            alert('Atualizado com sucesso!');
            const href = $(this ).attr('href');
            $('document').load(href);
            console.log(data);
        })
        .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`))
    })
});