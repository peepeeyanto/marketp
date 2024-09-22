// Set constraints for the video stream
let constraints = { video: { facingMode: "environment" }, audio: false };
let track = null;
const classNameMapping = {
  "0": "Standar",
  "1": "Tua",
  "2": "Tumbuh Tunas",
  "3": "Pecah" // Assuming the last index doesn't have a specific class name
};

let showingResults = false;

// Define constants
const cameraView = document.querySelector("#camera--view"),
    cameraOutput = document.querySelector("#camera--output"),
    cameraSensor = document.querySelector("#camera--sensor"),
    cameraTrigger = document.querySelector("#camera--trigger"),
    predictionSpan = document.querySelector("#prediction"),
    statusSpan = document.querySelector("#statusSpan"),
    currentTaskImage = document.querySelector("#currentTask");


// Access the device camera and stream to cameraView
function cameraStart() {
    navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function(stream) {
            track = stream.getTracks()[0];
            cameraView.srcObject = stream;
        })
        .catch(function(error) {
            console.error("Oops. Something is broken.", error);
        });
}

// Take a picture when cameraTrigger is tapped
cameraTrigger.onclick = async function() {

  if(!showingResults) {
    cameraSensor.width = cameraView.videoWidth;
    cameraSensor.height = cameraView.videoHeight;
    cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
    cameraOutput.src = cameraSensor.toDataURL("image/webp");
    cameraOutput.classList.add("taken");

    applyStyleAndShowStatus(true);
    let prediction = await predictModal();
    let res = transform(prediction, classNameMapping);
    statusSpan.classList.remove("statusSpanClass");
    statusSpan.innerHTML = '';
    predictionSpan.classList.add("prediction");
    predictionSpan.innerHTML = showResults(res);

    changeCurrentTask(false);
    showingResults = true;
  }
  else {
    applyStyleAndShowStatus(false);
    removePhotoFromFrame();
    changeCurrentTask(true);
    showingResults = false;
  }
    

};

function applyStyleAndShowStatus(show) {
  if(show) {
    statusSpan.classList.add("statusSpanClass");
    statusSpan.innerHTML = "<img class='searching' src='/images/searching.gif' alt='Scanning'>";
  }
  else {
    predictionSpan.classList.remove("prediction");
    predictionSpan.innerHTML = "";
  }
}

function removePhotoFromFrame () {


  requestAnimationFrame(function() {
    cameraOutput.classList.add("leaveFrame");
  });
  
  updateClass();
}

async function updateClass() {
  // cameraOutput.classList.remove("taken");

  setTimeout(function() {
    cameraOutput.src = "";
    cameraOutput.classList.remove("taken");
    cameraOutput.classList.remove("leaveFrame");
  }, 750);
}

function changeCurrentTask (ready) {
  if(ready) {
    currentTaskImage.src = "/images/search.png";
  }
  else {
    currentTaskImage.src = "/images/cancel.png";
  }
}

function showResults(props) {
    let html = "<div style='margin-bottom: 0.5rem;'>Picture of a:</div><ul class='predictions'>"
    props.forEach(element => {
      html  += "<li>" + 
                  "<div class='predictionDiv'>" + element.className + "</div>"
                  + "<div class='predictionPercentage'>" + getPercentage(parseFloat(element.probability)) + "</div>" 
              + "</li>";
    });
    html += "</ul>";
    return html;
}


// function to conver the string input 0.5909343 to a percentage
function getPercentage (number) {
    return (number * 100).toFixed(2) + "%";
}



async function predictModal () {
  let img = document.getElementById('camera--output');

  const model = await tf.loadLayersModel('./model.json');
  const imageTensor = tf.browser.fromPixels(img);
  // Preprocess the image if necessary (e.g., resize, normalize)
  const resizedImage = tf.image.resizeBilinear(imageTensor, [224, 224]);
  const normalizedImage = resizedImage.div(tf.scalar(255.0));
  // Add a batch dimension to the image tensor
  const batchedImage = normalizedImage.expandDims(0);
  // Run the model on the image tensor
  const prediction = model.predict(batchedImage);
  // Postprocess the prediction if necessary
  const predictionData = await prediction.data();
  console.log(predictionData)
  return predictionData
}
// Start the video stream when the window loads
window.addEventListener("load", cameraStart, false);

function transform(originalObject, classNameMapping) {
  const result = [];
  for (let index in originalObject) {
      const probability = originalObject[index];
      const className = classNameMapping[index];
      result.push({
          "className": className,
          "probability": probability
      });
  }
  console.log(result);
  return result;
}

if('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('serviceworker.js')
      .then((reg) => console.log('Success: ', reg.scope))
      .catch((err) => console.log('Failure: ', err));
  })
}