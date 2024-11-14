<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        #reader {
            width: 300px;
            height: 300px;
            border: 2px solid #333;
            border-radius: 10px;
            overflow: hidden;
        }
        #result {
            margin-top: 20px;
            font-size: 18px;
        }
        #startButton {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #startButton:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <a class="btn btn-outline-danger m-2" href="../../../index.php" width="200"> Back </a>
    <p>Please Start the button then Place the QR on the Box</p>
    <video id="reader"></video>
    <button id="startButton">Start Scanning</button>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"><strong> QR Successfully Identify:</strong> <br> <span id="nurseryID"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="redirectButton" class="btn btn-primary">Go to Plant Info</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                const videoElement = document.getElementById('video');
                videoElement.srcObject = stream;
                videoElement.play();
            })
            .catch(function(err) {
                console.error("Error accessing camera: " + err);
            });


        const codeReader = new ZXing.BrowserQRCodeReader();
        let selectedDeviceId;

        $(document).ready(function() {
            $('#startButton').click(function() {
                startScanning();
            });

            // Redirect to the URL when the button is clicked
            $('#redirectButton').click(function() {
                const nurseryID = $('#nurseryID').text(); // Get the scanned plant ID
                const redirectUrl = `result.php?nurseryID=${nurseryID}`;
                window.location.href = redirectUrl; // Redirect to the URL
            });
        });

        function startScanning() {
            codeReader.getVideoInputDevices()
                .then((videoInputDevices) => {
                    // Select the first back camera or environment-facing camera
                    selectedDeviceId = videoInputDevices.find(device => device.label.toLowerCase().includes('back'))?.deviceId || videoInputDevices[0].deviceId;
                    return codeReader.decodeFromVideoDevice(selectedDeviceId, 'reader', (result, err) => {
                        if (result) {
                            console.log(result);
                            $('#result').text(result.text);
                            $('#nurseryID').text(result.text); // Set the plant ID in the modal
                            $('#resultModal').modal('show'); // Show the modal
                            codeReader.reset(); // Stop scanning
                        }
                        if (err && !(err instanceof ZXing.NotFoundException)) {
                            console.error(err);
                            $('#result').text('Error: ' + err);
                        }
                    });
                })
                .catch((err) => {
                    console.error(err);
                    $('#result').text('Error: ' + err);
                });
        }
    </script>
</body>
</html>
