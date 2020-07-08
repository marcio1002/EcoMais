var amount = $('#amount').val();
//var amount = "600.00";
pagamento();

function pagamento() {
    $('.bankName').hide();
    $('.creditCard').hide();

    var endereco = jQuery('.endereco').attr("data-endereco");
    $.ajax({

        url: endereco + "pagamento.php",
        type: 'POST',
        dataType: 'json',
        success: function (retorno) {

            PagSeguroDirectPayment.setSessionId(retorno.id);
        },
        complete: function (retorno) {
            listarMeiosPag();
        }
    });
}



$('#numCartao').on('keyup', function () {

    var numCartao = $(this).val();

    var qntNumero = numCartao.length;

    if (qntNumero == 6) {

        PagSeguroDirectPayment.getBrand({
            cardBin: numCartao,
            success: function (retorno) {
                $('#msg').empty();

                var imgBand = retorno.brand.name;
                $('.bandeira-cartao').html("<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/" + imgBand + ".png'>");
                $('#bandeiraCartao').val(imgBand);
                recupParcelas(imgBand);
            },
            error: function (retorno) {

                $('.bandeira-cartao').empty();
                $('#msg').html("Cartão inválido");
            }
        });
    }
});


$("#formPagamento").on("submit", function (event) {
    event.preventDefault();
    var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
    console.log(paymentMethod);

    if (paymentMethod == 'creditCard') {
        PagSeguroDirectPayment.createCardToken({
            cardNumber: $('#numCartao').val(),
            brand: $('#bandeiraCartao').val(), 
            cvv: $('#cvvCartao').val(), 
            expirationMonth: $('#mesValidade').val(), 
            expirationYear: $('#anoValidade').val(), 
            success: function (retorno) {
                $('#tokenCartao').val(retorno.card.token);
                recupHashCartao();
            },
            error: function (retorno) {
                
            },
            complete: function (retorno) {
                                
            }
        });
    } else if (paymentMethod == 'boleto') {
        recupHashCartao();
    } else if (paymentMethod == 'eft') {
        recupHashCartao();
    }

});

function recupHashCartao() {
    PagSeguroDirectPayment.onSenderHashReady(function (retorno) {
        if (retorno.status == 'error') {
            console.log(retorno.message);
            return false;
        } else {
            $("#hashCartao").val(retorno.senderHash);
            var dados = $("#formPagamento").serialize();
            console.log(dados);

            var endereco = jQuery('.endereco').attr("data-endereco");
            console.log(endereco);
            $.ajax({
                method: "POST",
                url: endereco + "proc_pag.php",
                data: dados,
                dataType: 'json',
                success: function (retorna) {
                    console.log("Sucesso " + JSON.stringify(retorna));
                    $("#msg").html('<p style="color: green">Transação realizada com sucesso</p>');
                },
                error: function (retorna) {
                    console.log("Erro" + JSON.stringify(retorna));
                    $("#msg").html('<p style="color: #FF0000">Erro ao realizar a transação</p>')
                }
            });
        }
    });
}

function tipoPagamento(paymentMethod){
    if(paymentMethod == "creditCard"){
        $('.creditCard').show();
        $('.bankName').hide();
    }
    if(paymentMethod == "boleto"){
        $('.creditCard').hide();
        $('.bankName').hide();
    }
    if(paymentMethod == "eft"){
        $('.creditCard').hide();
        $('.bankName').show();
    }
}