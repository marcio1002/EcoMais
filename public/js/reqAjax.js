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
        const data = { image: $('input[name=image]').val() };

        $.post("../controller/deleteImage.php", data,)
        .done((data) =>{
            alert('Deletado com sucesso!');
            location.href = "../view/mostrar.php";
            console.log(data.toString());
        })
        .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`))
    })
    $("#btnUpdate").click(function (){
        
        const data = {
            name: $('input[name=name]').val(),
            email: $('input[name=email]').val(),
            passwd: $('input[name=passwd]').val(),
            id: $('input[name=id]').val(),
        }
        $.post("../controller/update.php", data,)
        .done((data) =>{
            alert('Atualizado com sucesso!');
            location.href = "../view/mostrar.php";
            console.log(data.toString());
        })
        .fail((xhr,desc,err)=> console.log(`ErrXHR: ${xhr} \n Description: ${desc} \n Error: ${err}`))
    })
});