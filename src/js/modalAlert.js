/** 
* @param {Object} option;
* optições para modal
*/

const op =  {
    opModal: {
        opacity: 0.5,
        inDuration: null,
        outDuration: null,
        onOpenStart: null,
        onOpenEnd: null,
        onCloseStart: null,
        onCloseEnd: null,
        preventScrolling: true,
        dismissible: true,
        StartingTop: '1%',
        endingTop: "10%",
    },
    accept: Function,
    cancel: Function,
}

function modalAlert(option = op) {

    $('.modal').modal(option.opModal);

    const modal = M.Modal.getInstance($('.modal'));
    
    modal.open();
    
    $('.btn-accept').click(() => option.accept() );

    $('.btn-cancel').click(() => option.cancel() );
}