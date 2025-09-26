<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Photobooth - Farm Guide</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(135deg, #1e4d2b 0%, #2d5233 25%, #4bbf6b 50%, #6ecf87 75%, #8ee5a3 100%);
            min-height: 100vh;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .photobooth-container {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 30px;
            align-items: start;
        }

        .camera-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .camera-container {
            position: relative;
            margin-bottom: 20px;
        }

        #video {
            width: 100%;
            max-width: 640px;
            height: 480px;
            border-radius: 10px;
            background: #000;
            object-fit: cover;
        }

        #canvas {
            display: none;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4bbf6b, #6ecf87);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(75, 191, 107, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .gallery-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .gallery-header {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            max-height: 500px;
            overflow-y: auto;
        }

        .gallery-item {
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            display: none;
        }

        .status-success {
            background: rgba(75, 191, 107, 0.3);
            color: white;
        }

        .status-error {
            background: rgba(220, 53, 69, 0.3);
            color: white;
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 15px;
        }

        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 3px solid white;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .photobooth-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            #video {
                height: 320px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📸 Photobooth</h1>
            <p>Capture memories with our interactive photobooth!</p>
        </div>

        <div class="photobooth-container">
            <div class="camera-section">
                <div class="camera-container">
                    <video id="video" autoplay></video>
                    <canvas id="canvas"></canvas>
                </div>
                
                <div class="controls">
                    <button id="startCamera" class="btn btn-secondary">Start Camera</button>
                    <button id="capturePhoto" class="btn btn-primary" disabled>📸 Capture Photo</button>
                    <button id="stopCamera" class="btn btn-secondary" disabled>Stop Camera</button>
                </div>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Processing your photo...</p>
                </div>

                <div class="status-message" id="statusMessage"></div>
            </div>

            <div class="gallery-section">
                <div class="gallery-header">Recent Photos</div>
                <div class="gallery-grid" id="galleryGrid">
                    <!-- Photos will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        class Photobooth {
            constructor() {
                this.video = document.getElementById('video');
                this.canvas = document.getElementById('canvas');
                this.ctx = this.canvas.getContext('2d');
                this.stream = null;
                
                this.startCameraBtn = document.getElementById('startCamera');
                this.captureBtn = document.getElementById('capturePhoto');
                this.stopCameraBtn = document.getElementById('stopCamera');
                this.statusMessage = document.getElementById('statusMessage');
                this.loading = document.getElementById('loading');
                this.galleryGrid = document.getElementById('galleryGrid');

                this.initEventListeners();
                this.loadGallery();
                
                // Set canvas dimensions
                this.canvas.width = 640;
                this.canvas.height = 480;
            }

            initEventListeners() {
                this.startCameraBtn.addEventListener('click', () => this.startCamera());
                this.captureBtn.addEventListener('click', () => this.capturePhoto());
                this.stopCameraBtn.addEventListener('click', () => this.stopCamera());
            }

            async startCamera() {
                try {
                    this.stream = await navigator.mediaDevices.getUserMedia({ 
                        video: { width: 640, height: 480 } 
                    });
                    this.video.srcObject = this.stream;
                    
                    this.startCameraBtn.disabled = true;
                    this.captureBtn.disabled = false;
                    this.stopCameraBtn.disabled = false;
                    
                    this.showStatus('Camera started successfully!', 'success');
                } catch (error) {
                    console.error('Error starting camera:', error);
                    this.showStatus('Failed to start camera. Please check your permissions.', 'error');
                }
            }

            stopCamera() {
                if (this.stream) {
                    this.stream.getTracks().forEach(track => track.stop());
                    this.stream = null;
                    this.video.srcObject = null;
                }
                
                this.startCameraBtn.disabled = false;
                this.captureBtn.disabled = true;
                this.stopCameraBtn.disabled = true;
                
                this.showStatus('Camera stopped.', 'success');
            }

            async capturePhoto() {
                if (!this.stream) {
                    this.showStatus('Please start the camera first.', 'error');
                    return;
                }

                // Draw video frame to canvas
                this.ctx.drawImage(this.video, 0, 0, this.canvas.width, this.canvas.height);
                
                // Convert to base64
                const imageData = this.canvas.toDataURL('image/png');
                
                this.showLoading(true);
                
                try {
                    const response = await fetch('/photobooth/capture', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ image: imageData })
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        this.showStatus(result.message, 'success');
                        this.loadGallery(); // Refresh gallery
                    } else {
                        this.showStatus(result.message, 'error');
                    }
                } catch (error) {
                    console.error('Error capturing photo:', error);
                    this.showStatus('Failed to save photo.', 'error');
                } finally {
                    this.showLoading(false);
                }
            }

            async loadGallery() {
                try {
                    const response = await fetch('/photobooth/gallery');
                    const result = await response.json();
                    
                    if (result.success) {
                        this.displayGallery(result.photos);
                    }
                } catch (error) {
                    console.error('Error loading gallery:', error);
                }
            }

            displayGallery(photos) {
                this.galleryGrid.innerHTML = '';
                
                if (photos.length === 0) {
                    this.galleryGrid.innerHTML = '<p style="grid-column: 1/-1; text-align: center; opacity: 0.7;">No photos yet. Start capturing!</p>';
                    return;
                }
                
                photos.forEach(photo => {
                    const item = document.createElement('div');
                    item.className = 'gallery-item';
                    item.innerHTML = `<img src="${photo.url}" alt="Photo" loading="lazy">`;
                    item.addEventListener('click', () => {
                        window.open(photo.url, '_blank');
                    });
                    this.galleryGrid.appendChild(item);
                });
            }

            showStatus(message, type) {
                this.statusMessage.textContent = message;
                this.statusMessage.className = `status-message status-${type}`;
                this.statusMessage.style.display = 'block';
                
                setTimeout(() => {
                    this.statusMessage.style.display = 'none';
                }, 4000);
            }

            showLoading(show) {
                this.loading.style.display = show ? 'block' : 'none';
            }
        }

        // Initialize photobooth when page loads
        document.addEventListener('DOMContentLoaded', () => {
            new Photobooth();
        });
    </script>
</body>
</html>