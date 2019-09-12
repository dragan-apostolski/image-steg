let messages = []

function encode_messages(img){
    let jsonString = JSON.stringify(messages);
    let encoded_img = steg.encode(jsonString, img);
    return encoded_img;
  }
  
  function decodeAndShowMessages(img){
    let decodedText = steg.decode(img);
    if (decodedText.length == 0) return;
    messages = JSON.parse(decodedText)
    updateMessageList(messages);
  }
  



function getUsedRemainingCharacters(newMsgLength, imgCapacity){
  messagesLength = getMessagesLength();
  newLength = messagesLength + newMsgLength
  return newLength.toString() + "/" + imgCapacity.toString();
}

  function getPercentFull(imgCapacity){
    let messagesLength = getMessagesLength();
    let perctangeFull = (messagesLength/imgCapacity) * 100;
    return perctangeFull.toString() + "%";
}

function getMessagesLength(){
  let messagesLength = 0;
  messages.forEach(msg => {
    messagesLength += msg["title"].length;
    messagesLength += msg["content"].length;
  });
  return messagesLength;
}
