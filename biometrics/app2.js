var test = null;

var myVal = ""; // Drop down selected value of reader 
var disabled = true;
var startEnroll = false;

var currentFormat = Fingerprint.SampleFormat.Raw;
var deviceTechn = {
               0: "Unknown",
               1: "Optical",
               2: "Capacitive",
               3: "Thermal",
               4: "Pressure"
            }

var deviceModality = {
               0: "Unknown",
               1: "Swipe",
               2: "Area",
               3: "AreaMultifinger"
            }

var deviceUidType = {
               0: "Persistent",
               1: "Volatile"
            }

var FingerprintSdkTest = (function () {
    function FingerprintSdkTest() {
        var _instance = this;
        this.operationToRestart = null;
        this.acquisitionStarted = false;
        this.sdk = new Fingerprint.WebApi;
        this.sdk.onDeviceConnected = function (e) {
            // Detects if the deveice is connected for which acquisition started
            showMessage("Scan your finger");
        };
        this.sdk.onDeviceDisconnected = function (e) {
            // Detects if device gets disconnected - provides deviceUid of disconnected device
            showMessage("Device disconnected");
        };
        this.sdk.onCommunicationFailed = function (e) {
            // Detects if there is a failure in communicating with U.R.U web SDK
            showMessage("Communinication Failed")
        };
        this.sdk.onSamplesAcquired = function (s) {
            // Sample acquired event triggers this function
            console.log(s);
                sampleAcquired(s);
        };
        this.sdk.onQualityReported = function (e) {
            // Quality of sample aquired - Function triggered on every sample acquired
            $("#fingerprint_logo").attr("src", "../biometrics/fingerprint1.gif");
            $("#quality").html(Fingerprint.QualityCode[(e.quality)]);
        }

    }

    FingerprintSdkTest.prototype.startCapture = function () {
        if (this.acquisitionStarted) // Monitoring if already started capturing
            return;
        var _instance = this;
        showMessage("");
        this.operationToRestart = this.startCapture;
        this.sdk.startAcquisition(currentFormat, myVal).then(function () {
            _instance.acquisitionStarted = true;

            //Disabling start once started
            // disableEnableStartStop();

        }, function (error) {
            showMessage(error.message);
        });
    };
    FingerprintSdkTest.prototype.stopCapture = function () {
        if (!this.acquisitionStarted) //Monitor if already stopped capturing
            return;
        var _instance = this;
        showMessage("");
        this.sdk.stopAcquisition().then(function () {
            _instance.acquisitionStarted = false;

            //Disabling stop once stoped
            // disableEnableStartStop();

        }, function (error) {
            showMessage(error.message);
        });
    };

    FingerprintSdkTest.prototype.getInfo = function () {
        var _instance = this;
        return this.sdk.enumerateDevices();
    };

    FingerprintSdkTest.prototype.getDeviceInfoWithID = function (uid) {
        var _instance = this;
        return  this.sdk.getDeviceInfo(uid);
    };

    
    return FingerprintSdkTest;
})();

function showMessage(message){
    var _instance = this;
    //var statusWindow = document.getElementById("status");
    $("#status").html(message);
}

window.onload = function () {
    // localStorage.clear();
    test = new FingerprintSdkTest();
    onGetInfo();
    // readersDropDownPopulate(true); //To populate readers for drop down selection
    // disableEnable(); // Disabling enabling buttons - if reader not selected
    // enableDisableScanQualityDiv("content-reader"); // To enable disable scan quality div
    // disableEnableExport(true);
};

function onGetInfo() {
    var allReaders = test.getInfo();    
    allReaders.then(function (sucessObj) {
        myVal = sucessObj[0];
        test.startCapture();
    }, function (error){
        showMessage(error.message);
    });
}

function onStop() {
    test.stopCapture();
}

function sampleAcquired(s){   
            if(currentFormat == Fingerprint.SampleFormat.PngImage){   
            // If sample acquired format is PNG- perform following call on object recieved 
            // Get samples from the object - get 0th element of samples as base 64 encoded PNG image  
            // var state = localStorage.getItem("state");
                // if (state == "1") {
                    localStorage.setItem("imageSrc", "");                
                    var samples = JSON.parse(s.samples);            
                    // localStorage.setItem("imageSrc", "data:image/png;base64," + Fingerprint.b64UrlTo64(samples[0]));
                    localStorage.setItem("imageSrc", Fingerprint.b64UrlTo64(samples[0]));
                    // var image = '<img src="'+localStorage.getItem("imageSrc")+'" alt="fingerprint" style="width: 100%; height: 100%;" >';
                    // $('#imagediv').html(image);
                    $("#scan_success").html("Fingerprint Scan Successful");
                    console.log(samples);
                // } else {
                //     onStop();
                // }
            }

            else if(currentFormat == Fingerprint.SampleFormat.Raw){  
                // If sample acquired format is RAW- perform following call on object recieved 
                // Get samples from the object - get 0th element of samples and then get Data from it.
                // Returned data is Base 64 encoded, which needs to get decoded to UTF8,
                // after decoding get Data key from it, it returns Base64 encoded raw image data
                localStorage.setItem("raw", "");
                var samples = JSON.parse(s.samples);
                var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
                var decodedData = JSON.parse(Fingerprint.b64UrlToUtf8(sampleData));
                localStorage.setItem("raw", Fingerprint.b64UrlTo64(decodedData.Data));
                console.log(sampleData);
                
                console.log(Fingerprint.b64UrlTo64(decodedData.Data));
                var data = window.btoa(decodedData);
                console.log(data);
                var image = '<img src="data:image/png;base64,'+Fingerprint.b64UrlTo64(decodedData.Data)+'" alt="fingerprint" style="width: 100%; height: 100%;" >';
                    $('#imagediv').html(image);
                // var vDiv = document.getElementById('imagediv').innerHTML = '<div id="animateText" style="display:none">RAW Sample Acquired <br>'+Date()+'</div>';
                // setTimeout('delayAnimate("animateText","table-cell")',100); 

                // disableEnableExport(false);
            }

            else if(currentFormat == Fingerprint.SampleFormat.Compressed){  
                // If sample acquired format is Compressed- perform following call on object recieved 
                // Get samples from the object - get 0th element of samples and then get Data from it.
                // Returned data is Base 64 encoded, which needs to get decoded to UTF8,
                // after decoding get Data key from it, it returns Base64 encoded wsq image
                localStorage.setItem("wsq", "");
                var samples = JSON.parse(s.samples);
                var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
                var decodedData = JSON.parse(Fingerprint.b64UrlToUtf8(sampleData));
                localStorage.setItem("wsq","data:application/octet-stream;base64," + Fingerprint.b64UrlTo64(decodedData.Data));

                var vDiv = document.getElementById('imagediv').innerHTML = '<div id="animateText" style="display:none">WSQ Sample Acquired <br>'+Date()+'</div>';
                setTimeout('delayAnimate("animateText","table-cell")',100);   

                disableEnableExport(false);
            }

            else if(currentFormat == Fingerprint.SampleFormat.Intermediate){  
                // If sample acquired format is Intermediate- perform following call on object recieved 
                // Get samples from the object - get 0th element of samples and then get Data from it.
                // It returns Base64 encoded feature set
                // localStorage.setItem("intermediate1", "");
                // localStorage.setItem("intermediate2", "");
                // localStorage.setItem("intermediate3", "");
                // localStorage.setItem("intermediate4", "");
                // localStorage.setItem("intermediate5", "");
                // localStorage.setItem("intermediate6", "");
                // localStorage.setItem("intermediate7", "");
                // localStorage.setItem("intermediate8", "");
                // localStorage.setItem("intermediate9", "");
                // localStorage.setItem("intermediate10", "");

                var fp = localStorage.getItem("fp");
                
                localStorage.setItem("intermediate", "");
                var samples = JSON.parse(s.samples);
                var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
                if (fp == ""||fp == null) {
                    $("#scan_success").html("Error Scanning");
                }
                else if (fp == "1") {
                    localStorage.setItem("intermediate1", sampleData);
                }
                else if(fp == "2"){
                    localStorage.setItem("intermediate2", sampleData);
                }
                else if(fp == "3"){
                    localStorage.setItem("intermediate3", sampleData);
                }
                else if(fp == "4"){
                    localStorage.setItem("intermediate4", sampleData);
                }
                else if(fp == "5"){
                    localStorage.setItem("intermediate5", sampleData);
                }
                else if(fp == "6"){
                    localStorage.setItem("intermediate6", sampleData);
                }
                else if(fp == "7"){
                    localStorage.setItem("intermediate7", sampleData);
                }
                else if(fp == "8"){
                    localStorage.setItem("intermediate8", sampleData);
                }
                else if(fp == "9"){
                    localStorage.setItem("intermediate9", sampleData);
                }
                else if(fp == "10"){
                    localStorage.setItem("intermediate10", sampleData);
                }
                $("#scan_success").html("Fingerprint Scan Successful");
            }

            else{
                alert("Format Error");
                //disableEnableExport(true);
            }    
}


// For Download and formats ends