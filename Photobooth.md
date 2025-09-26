# Photobooth Feature

Welcome to the Farm Guide Photobooth! This feature allows users to take photos using their device's camera and save them to a gallery.

## 📸 Features

- **Real-time Camera Access**: Access your device's front-facing camera
- **Photo Capture**: Take high-quality photos with a single click
- **Live Gallery**: View recently captured photos in an organized grid
- **Photo Effects**: Apply filters like grayscale, sepia, and vintage
- **Responsive Design**: Works on desktop, tablet, and mobile devices
- **Secure Storage**: Photos are saved securely on the server

## 🚀 Getting Started

### Prerequisites

- PHP 8.1 or higher
- Laravel 10.x
- Modern web browser with camera support
- Camera permissions granted

### Installation

The photobooth feature is already integrated into the Farm Guide application. Simply navigate to:

```
http://your-domain/photobooth
```

### Usage

1. **Start Camera**: Click the "Start Camera" button to access your device's camera
2. **Capture Photo**: Click the "📸 Capture Photo" button or press the spacebar
3. **View Gallery**: See your captured photos in the right sidebar
4. **Apply Effects**: Use the filter buttons to enhance your photos
5. **Download**: Click on any gallery image to view it full-size

## 🛠️ Files Structure

```
├── app/Http/Controllers/PhotoboothController.php  # Backend logic
├── resources/views/photobooth.blade.php          # Main interface
├── resources/js/Photobooth.js                    # JavaScript functionality
├── resources/css/photobooth.css                  # Styling
└── public/photos/                                 # Stored photos directory
```

## 🎨 Customization

### Styling

Edit `/resources/css/photobooth.css` to modify:
- Colors and themes
- Layout and spacing
- Animation effects
- Responsive breakpoints

### Functionality

Edit `/resources/js/Photobooth.js` to add:
- New photo effects
- Custom camera controls
- Advanced features
- Event handling

### Backend Logic

Edit `/app/Http/Controllers/PhotoboothController.php` to modify:
- Photo storage logic
- API responses
- Security settings
- File handling

## 🔧 Configuration

### Camera Settings

In `Photobooth.js`, you can modify camera options:

```javascript
const options = {
    videoWidth: 640,    // Camera resolution width
    videoHeight: 480,   // Camera resolution height
    quality: 0.9,       // Image quality (0-1)
    format: 'image/png' // Image format
};
```

### Storage Settings

Photos are stored in `public/photos/` directory. You can change this in `PhotoboothController.php`:

```php
$filepath = public_path('photos/' . $filename);
```

## 📱 Browser Compatibility

| Feature | Chrome | Firefox | Safari | Edge |
|---------|--------|---------|--------|------|
| Camera Access | ✅ | ✅ | ✅ | ✅ |
| Photo Capture | ✅ | ✅ | ✅ | ✅ |
| Filters | ✅ | ✅ | ✅ | ✅ |
| Download | ✅ | ✅ | ✅ | ✅ |

## 🔐 Security Features

- CSRF protection on all POST requests
- File type validation
- Secure file naming with timestamps
- Directory traversal prevention
- Input sanitization

## 🐛 Troubleshooting

### Camera Not Working

1. **Check Permissions**: Ensure camera permissions are granted
2. **HTTPS Required**: Camera access requires HTTPS in production
3. **Browser Support**: Use a modern browser
4. **Hardware**: Check if camera is connected and working

### Photos Not Saving

1. **Directory Permissions**: Ensure `public/photos/` is writable
2. **Disk Space**: Check available storage space
3. **File Size**: Large photos may exceed upload limits
4. **Server Configuration**: Check PHP upload settings

### Common Error Messages

- **"Camera access denied"**: Grant camera permissions
- **"Failed to capture photo"**: Check storage permissions
- **"No camera found"**: Ensure camera is connected
- **"Browser not supported"**: Use Chrome, Firefox, Safari, or Edge

## 🚀 Advanced Features

### Adding Custom Filters

1. Edit `Photobooth.js`
2. Add a new filter function:

```javascript
applyCustomFilter(data) {
    // Your custom filter logic here
    for (let i = 0; i < data.length; i += 4) {
        // Modify RGB values
        data[i] = customRedValue;     // Red
        data[i + 1] = customGreenValue; // Green
        data[i + 2] = customBlueValue;  // Blue
    }
}
```

3. Add button to the interface
4. Call the filter function

### Integration with Other Systems

The photobooth can be integrated with:
- Social media sharing
- Cloud storage services
- Email systems
- User profiles
- Farm documentation

## 📞 Support

For technical support or feature requests:
- Open an issue in the GitHub repository
- Contact the development team
- Check the Laravel documentation for framework-related questions

## 📄 License

This photobooth feature is part of the Farm Guide application and follows the same license terms.

---

**Happy Photo Taking! 📸🌾**