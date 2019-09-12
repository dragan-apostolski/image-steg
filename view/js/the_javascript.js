
// $("#menu-toggle").click(function(e) {
//   e.preventDefault();
//   $("#wrapper").toggleClass("toggled");
// });

let dropZone = document.getElementById("drop-zone");
let msgSelect = document.getElementById("message-select");

['dragenter', 'dragover', 'dragleave'].forEach(eventName => {
     dropZone.addEventListener(eventName, preventDefaults, false)
  })
dropZone.addEventListener('drop', handleFileDrop, false)


function preventDefaults (e) {
  e.preventDefault()
  e.stopPropagation()
}

function handleFileDrop(e){
  preventDefaults(e);
  let file = e.dataTransfer.files[0]
  handleFileLoad(file);
}

function handleFileSelect(input) {
  let file = input.files[0];
  handleFileLoad(file);
}

function handleFileLoad(file){
  let imgType = file.type
  if ((imgType != "image/jpeg") && (imgType != "image/png")){
    document.getElementById("modal-body-error").innerText = "The file has to be an image in .jpeg or .png format!";
    $("#error-modal").modal("show");
    return;
  }
  imageName = file.name;
  messages = []
  resetElements();
  var reader = new FileReader();
  reader.onload = onFileLoad;
  reader.onloadend = onFileLoadEnd;
  reader.readAsDataURL(file);
}

function onFileLoad(e){
  $("#steg-container-wrapper").css("display", "flex");
  $("#image-name").text(imageName);
  $("#image-container").attr("src", e.target.result);
  $("#download-anchor").attr("download", imageName);
  $("#download-anchor").attr("href", $("#image-container").attr("src").replace("image/png", "image/octet-stream"));
  $('html, body').animate({
    scrollTop: $("#steg-container-wrapper").offset().top
  }, 1000);
}

function onFileLoadEnd(e){
  try{
    let img = document.getElementById("image-container");
    decodeAndShowMessages(img);
    updateProgress(img);
  }
  catch(exception){
    console.log(exception)
  }
}

function resetElements(){
  if(editing){
    quitEditing(messages[msgSelect.selectedIndex]);
  }
  document.getElementById("message-text").value = "";
  document.getElementById("message-view").value = "";
  document.getElementById("message-title").value = "";
  let select = document.getElementById("message-select");
  while(select.firstChild){
    select.removeChild(select.firstChild);
  }
}

function onBtnEncodeClick(){
  let messageText = document.getElementById("message-text").value;
  if (messageText.length == 0){
    document.getElementById("modal-body-error").innerText = "The message has to be at least one letter long.";
    $("#error-modal").modal("show");
    return;
  }
  let title = document.getElementById("message-title").value;
  let new_msg = {title: title, content: messageText};
  let img = document.getElementById("image-container");
  messages.push(new_msg);
  let encodedImg = encode_messages(img);
  afterEncodingRituals(messages, encodedImg);
}

function onBtnEditClick(){
  let msgView = document.getElementById("message-view");
  if (msgView.textLength == 0){
    document.getElementById("modal-body-error").innerText = "No message is selected for edit.";
    $("#error-modal").modal("show");
    return;
  }
  editing = true;
  $("#message-view").attr("readonly", false);
  $("#message-select").attr("hidden", true);
  $("#message-title-edit").attr("hidden", false);
  $("#btnEdit").attr("hidden", true);
  $("#cancel-update-cont").css("display", "flex");
  msgView.focus();
}

function onBtnUpdateClick(){
  let msgView = document.getElementById("message-view");
  let msgTitle = document.getElementById("message-title-edit");
  let img = document.getElementById("image-container");
  let selectedIndex = msgSelect.selectedIndex;
  let editedMsg = msgView.value;
  let editedTitle = msgTitle.value;
  let originalMsg = messages[msgSelect.selectedIndex]["content"];
  let originalTitle = messages[msgSelect.selectedIndex]["title"];
  if (editedTitle == originalTitle && editedMsg == originalMsg){
    document.getElementById("modal-body-error").innerText = "No change was made.";
    $("#error-modal").modal("show");
    resetMessageViewControls();
    return;
  }
  if(editedMsg.length == 0){
    editing = false;
    deleteMessage(msgSelect.selectedIndex);
    resetMessageViewControls();
    return;
  }
  messages[msgSelect.selectedIndex] = {title: editedTitle, content: editedMsg};
  resetMessageViewControls();
  msgSelect.selectedIndex = selectedIndex;
  let encodedImg = encode_messages(img);
  afterEncodingRituals(messages, encodedImg);
  editing = false;
}

function resetMessageViewControls(){
  $("#cancel-update-cont").css("display", "none");
  $("#btnEdit").attr("hidden", false);
  $("#message-view").attr("readonly", true);
  $("#message-title-edit").attr("hidden", true);
  $("#message-select").attr("hidden", false);
}

function deleteMessage(message_index){
  messages.pop(message_index);
  let img = document.getElementById("image-container");
  let encodedImg = encode_messages(img);
  afterEncodingRituals(messages, encodedImg);
}

function onBtnCancelClick(){
  editing = false;
  quitEditing(messages[msgSelect.selectedIndex]);
}

function quitEditing(originalMsg){
  let msgView = document.getElementById("message-view");
  let msgTitleEdit = document.getElementById("message-title-edit");
  msgView.value = originalMsg["content"];
  msgTitleEdit.value = originalMsg["title"];
  $("#message-view").attr("readonly", true);
  $("#message-select").attr("hidden", false);
  $("#message-title-edit").attr("hidden", true);
  $("#cancel-update-cont").css("display", "none");
  $("#btnEdit").attr("hidden", false);
}

function afterEncodingRituals(messages, encodedImg){
  $("#image-container").attr("src", encodedImg);
  $("#download-anchor").attr("download", imageName);
  $("#download-anchor").attr("href", $("#image-container").attr("src").replace("image/png", "image/octet-stream"));
  updateMessageList(messages);
  updateProgress(document.getElementById("image-container"));
  $('html, body').animate({
    scrollTop: $("#progress-bar-wrapper").offset().top
  }, 1000);
}

function updateMessageList(messages){
  if(messages.length == 0) {
    resetElements();
    return;
  }
  let selectBox = document.getElementById("message-select");
  resetElements();
  messages.forEach(message => {
    let option = document.createElement("option");
    if(message["title"].length > 0){
      option.append(document.createTextNode(message["title"]));
    }
    else{
      option.append(document.createTextNode(message["content"].substr(0, 10) + "..." ));
    }
    option.value = message["content"];
    selectBox.appendChild(option);
  });
  selectBox.children[selectBox.children.length - 1].selected = true;
  onSelectChange();
}

function updateProgress(img){
  let imgCapacity = steg.getHidingCapacity(img);
  let progressBar = document.getElementById("progress-bar");
  progressBar.style.width = getPercentFull(imgCapacity);
  progressBar.innerText = progressBar.style.width;
}

function onSelectChange(){
  let select = document.getElementById("message-select");
  let message = messages[select.selectedIndex]["content"];
  let messageTitle = messages[select.selectedIndex]["title"];  
  document.getElementById("message-view").value = message;
  document.getElementById("message-title-edit").value = messageTitle;
}

let previousSelection = null;
let editing = false;

$("#message-select").focus(function(){
  previousSelection = this.selectedIndex;
}).change(function(){
  if(editing){
    quitEditing(messages[previousSelection]);
    onSelectChange();
    editing = false;
  }
  else{
    onSelectChange();
  }
})
