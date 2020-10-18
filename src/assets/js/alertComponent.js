const interfaceOptions = {
  classNames: {} | [], 
  definitions: { 
    time: 100, 
    movable: true, 
    classNameShow: "push", 
    classNameHide: "unPush" 
  }, 
}

const alertFunc = {
  showAlert(classNameShow) {
    $("body").css("overflow-x","hidden")
    $("#alertComponent").addClass(classNameShow)
  },
  hideAlert(classNameHide) {
    $("body").css("overflow-x","hidden")
    $("#alertComponent").addClass(classNameHide).fadeOut(600)
  },
  stateCounter(val) {
    $("#progressBar").attr("aria-valuenow", val)
    $("#progressBar").css("width", `${val}%`)
  },
  counter({time, classNameHide}) {
    let count = 1
    let idContInterval = setInterval(() => {
      count += 1
      this.stateCounter(count)
      if (count == 100) {
        clearInterval(idContInterval)
        this.hideAlert(classNameHide)
      }
    }, time)
  },
  moveAlert(moveble = true) {
    if (moveble) {
      $("#alertComponent")
        .mousedown(() => $("body").mousemove(evt => $("#alertComponent").animate({ left: evt.pageX, top: evt.pageY }, 1)))
        .mouseup((evt) => $("body").off("mousemove"))
    }
  },
  createElementAlert({message,borderClassName = "",bgProgressName = "", title = ""}) {
    let boxCard = $("<div id='alertComponent' class='alertComponent col-xl-3 col-md-4 col-sm-9 position-absolute position-alert'><div/>")

    let card = $(`<div class='card shadow ${borderClassName}'></div>`)

    let cardHeader = $("<div class='card-header py-1 text-center bg-white'></div>")

    let cardBody = $("<div class='card-body bg-light'></div>")

    let cardMessage = $("<div class='row no-gutters align-items-center'></div>")
      .append(`<div class="text-capitalize text-dark text-center font-size-1em text-weight-600">${message}</div>`)

    let cardFooter = $("<div class='card-footer p-1 border-top-0 bg-transparent'></div>")

    let boxProgress =  $("<div cla='w-100 h-auto'></div>")

    let progress = $("<div></div>").addClass("progress progress-sm mr-2")

    let progressBar = (bgProgressName.length) ? $(`<div id='progressBar' class='progress-bar ${bgProgressName}'></div>`)
    .attr({"role": "progressbar","aria-valuenow": "0", "aria-valuemin": "0", "aria-valuemax": "100"})
    .css("width","0") : ""

    if(progressBar.length) boxProgress.append(progress.append(progressBar))
      cardFooter.append(boxProgress)
      cardBody.append(cardMessage)

    if(title.length) {
      cardHeader.append(`<h5>${title}</h5>`)
      card.append(cardHeader)
    }
    
    card.append(cardBody,cardFooter)
    boxCard.append(card)
    $("body").append(boxCard)
  }
}

const alertComponent = {
  settings(options = interfaceOptions) {
    const {classNames, definitions:{time, movable, classNameShow, classNameHide} } = interfaceOptions
    
    if(classNames) $("#alertComponent").cdd(classNames)

    alertFunc.showAlert(classNameShow)
    alertFunc.counter({time, classNameHide})
    alertFunc.moveAlert(movable)
  },
  alertWarning(message,title="") {
    alertFunc.createElementAlert({message,title, borderClassName: "border-left-warning", bgProgressName: "bg-indigo"})

    return this
  },
  alertError(message,title="") {
    alertFunc.createElementAlert({message,title, borderClassName: "border-left-danger", bgProgressName: "bg-danger"})
    return this
  },
}




/* alertComponent.alertWarning( 
  "Usuário não autenticado",
  "Aviso",
).settings({
  definitions: {
    classNameShow: "topPush",
    classNameHide: "topUnPush"
  }
})
 */