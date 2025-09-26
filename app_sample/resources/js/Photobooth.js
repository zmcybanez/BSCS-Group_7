/**
 * Photobooth.js
 * Interactive photobooth functionality for the Farm Guide application
 * 
 * Features:
 * - Camera access and control
 * - Photo capture and storage
 * - Gallery management
 * - Real-time preview
 */

class PhotoboothManager {
    constructor(options = {}) {
        this.options = {
            videoWidth: 640,
            videoHeight: 480,
            quality: 0.9,
            format: 'image/png',
            ...options
        };
        
        this.video = null;
        this.canvas = null;
        this.ctx = null;
        this.stream = null;
        this.isRecording = false;
        
        this.init();
    }

    /**
     * Initialize the photobooth manager
     */
    init() {
        this.setupElements();
        this.bindEvents();
        console.log('Photobooth Manager initialized');
    }

    /**
     * Setup DOM elements
     */
    setupElements() {
        this.video = document.getElementById('video');
        this.canvas = document.getElementById('canvas');
        
        if (this.canvas) {
            this.ctx = this.canvas.getContext('2d');
            this.canvas.width = this.options.videoWidth;
            this.canvas.height = this.options.videoHeight;
        }
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Add keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.code === 'Space' && this.stream) {
                e.preventDefault();
                this.capturePhoto();
            }
        });
    }

    /**
     * Request camera access
     */
    async requestCameraAccess() {
        try {
            const constraints = {
                video: {
                    width: { ideal: this.options.videoWidth },
                    height: { ideal: this.options.videoHeight },
                    facingMode: 'user' // Front-facing camera
                }
            };

            this.stream = await navigator.mediaDevices.getUserMedia(constraints);
            return true;
        } catch (error) {
            console.error('Camera access denied:', error);
            this.handleCameraError(error);
            return false;
        }
    }

    /**
     * Start camera stream
     */
    async startCamera() {
        if (!this.video) {
            console.error('Video element not found');
            return false;
        }

        const hasAccess = await this.requestCameraAccess();
        if (!hasAccess) return false;

        this.video.srcObject = this.stream;
        
        return new Promise((resolve) => {
            this.video.onloadedmetadata = () => {
                this.video.play();
                resolve(true);
            };
        });
    }

    /**
     * Stop camera stream
     */
    stopCamera() {
        if (this.stream) {
            this.stream.getTracks().forEach(track => {
                track.stop();
            });
            this.stream = null;
        }

        if (this.video) {
            this.video.srcObject = null;
        }
    }

    /**
     * Capture a photo from the video stream
     */
    capturePhoto() {
        if (!this.video || !this.canvas || !this.stream) {
            console.error('Cannot capture photo: missing elements or stream');
            return null;
        }

        // Draw the current video frame to canvas
        this.ctx.drawImage(
            this.video, 
            0, 0, 
            this.canvas.width, 
            this.canvas.height
        );

        // Convert to data URL
        const dataURL = this.canvas.toDataURL(this.options.format, this.options.quality);
        
        // Add timestamp and effects if needed
        this.addTimestamp();
        
        return dataURL;
    }

    /**
     * Add timestamp overlay to the captured photo
     */
    addTimestamp() {
        if (!this.ctx) return;

        const now = new Date();
        const timestamp = now.toLocaleString();
        
        // Style the timestamp
        this.ctx.font = '16px Montserrat, Arial, sans-serif';
        this.ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
        this.ctx.strokeStyle = 'rgba(0, 0, 0, 0.5)';
        this.ctx.lineWidth = 2;
        
        // Position at bottom right
        const x = this.canvas.width - 200;
        const y = this.canvas.height - 20;
        
        this.ctx.strokeText(timestamp, x, y);
        this.ctx.fillText(timestamp, x, y);
    }

    /**
     * Apply photo filters/effects
     */
    applyFilter(filterType) {
        if (!this.ctx || !this.canvas) return;

        const imageData = this.ctx.getImageData(0, 0, this.canvas.width, this.canvas.height);
        const data = imageData.data;

        switch (filterType) {
            case 'grayscale':
                this.applyGrayscaleFilter(data);
                break;
            case 'sepia':
                this.applySepiaFilter(data);
                break;
            case 'vintage':
                this.applyVintageFilter(data);
                break;
            case 'brightness':
                this.applyBrightnessFilter(data, 1.2);
                break;
        }

        this.ctx.putImageData(imageData, 0, 0);
    }

    /**
     * Apply grayscale filter
     */
    applyGrayscaleFilter(data) {
        for (let i = 0; i < data.length; i += 4) {
            const gray = data[i] * 0.299 + data[i + 1] * 0.587 + data[i + 2] * 0.114;
            data[i] = gray;
            data[i + 1] = gray;
            data[i + 2] = gray;
        }
    }

    /**
     * Apply sepia filter
     */
    applySepiaFilter(data) {
        for (let i = 0; i < data.length; i += 4) {
            const r = data[i];
            const g = data[i + 1];
            const b = data[i + 2];

            data[i] = Math.min(255, r * 0.393 + g * 0.769 + b * 0.189);
            data[i + 1] = Math.min(255, r * 0.349 + g * 0.686 + b * 0.168);
            data[i + 2] = Math.min(255, r * 0.272 + g * 0.534 + b * 0.131);
        }
    }

    /**
     * Apply vintage filter
     */
    applyVintageFilter(data) {
        for (let i = 0; i < data.length; i += 4) {
            data[i] = Math.min(255, data[i] * 1.2);     // Red boost
            data[i + 1] = Math.min(255, data[i + 1] * 1.1); // Green slight boost
            data[i + 2] = Math.max(0, data[i + 2] * 0.8);   // Blue reduction
        }
    }

    /**
     * Apply brightness filter
     */
    applyBrightnessFilter(data, factor) {
        for (let i = 0; i < data.length; i += 4) {
            data[i] = Math.min(255, data[i] * factor);
            data[i + 1] = Math.min(255, data[i + 1] * factor);
            data[i + 2] = Math.min(255, data[i + 2] * factor);
        }
    }

    /**
     * Handle camera access errors
     */
    handleCameraError(error) {
        let message = 'Camera access failed. ';
        
        switch (error.name) {
            case 'NotAllowedError':
                message += 'Please grant camera permission and refresh the page.';
                break;
            case 'NotFoundError':
                message += 'No camera found on this device.';
                break;
            case 'NotSupportedError':
                message += 'Camera is not supported in this browser.';
                break;
            default:
                message += 'Please check your camera and try again.';
        }
        
        this.showError(message);
    }

    /**
     * Show error message to user
     */
    showError(message) {
        const errorElement = document.getElementById('cameraError');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        } else {
            alert(message);
        }
    }

    /**
     * Download captured photo
     */
    downloadPhoto(dataURL, filename = null) {
        if (!filename) {
            const now = new Date();
            filename = `photobooth_${now.getFullYear()}${(now.getMonth()+1).toString().padStart(2,'0')}${now.getDate().toString().padStart(2,'0')}_${now.getHours().toString().padStart(2,'0')}${now.getMinutes().toString().padStart(2,'0')}.png`;
        }

        const link = document.createElement('a');
        link.download = filename;
        link.href = dataURL;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    /**
     * Get device camera info
     */
    async getCameraInfo() {
        try {
            const devices = await navigator.mediaDevices.enumerateDevices();
            const cameras = devices.filter(device => device.kind === 'videoinput');
            return cameras.map(camera => ({
                id: camera.deviceId,
                label: camera.label || 'Camera',
                facing: camera.label.toLowerCase().includes('front') ? 'front' : 'back'
            }));
        } catch (error) {
            console.error('Error getting camera info:', error);
            return [];
        }
    }

    /**
     * Check if camera is supported
     */
    static isCameraSupported() {
        return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
    }

    /**
     * Cleanup resources
     */
    destroy() {
        this.stopCamera();
        this.video = null;
        this.canvas = null;
        this.ctx = null;
    }
}

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PhotoboothManager;
}

// Auto-initialize if DOM is loaded
if (typeof window !== 'undefined') {
    window.PhotoboothManager = PhotoboothManager;
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            window.photoboothManager = new PhotoboothManager();
        });
    } else {
        window.photoboothManager = new PhotoboothManager();
    }
}