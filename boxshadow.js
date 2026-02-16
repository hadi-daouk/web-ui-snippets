
function copyToClipboard(id) {
    var codeContent = document.getElementById(id);
    var codeText = codeContent.innerText || codeContent.textContent;
    
    var tempTextArea = document.createElement("textarea");
    tempTextArea.value = codeText;
    
    document.body.appendChild(tempTextArea);
    
    tempTextArea.select();
    
    document.execCommand("copy");
    
    document.body.removeChild(tempTextArea);
    
    alert("Code copied to clipboard!");
  }
  