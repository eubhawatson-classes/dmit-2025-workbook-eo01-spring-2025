# Image Processing Methods

## Table of Contents

- [GD Graphics Library](#gd-graphics-library)
- [How The Process Works](#how-the-process-works)
- [A Note On MIME Types](#a-note-on-mime-types)

---

## GD Graphics Library

The GD Graphics Library (originally 'GIF Draw Library', now informally 'Graphics Draw Library') is a graphics software library for 'dynamically manipulating images'[^1]. In short, it has over 100 functions that allow developers to create, edit, merge, convert, and output images in various formats. It supports many back-end programming languages, including PHP. 

The most important feature is that it's non-destructive. This means that PHP will always work with a copy of an image, not the original. 


### Double-Checking Our PHP Installation

The GD extension for image creation and manipulation is enabled in most popular PHP distributions; however, it's not part of the PHP core, so you need to verify that it's enabled on your server by running `phpinfo()`. 

All the installed modules are alphabetical, but what we're looking for is past the core section. It will tell you which image types are supported (JPEG, GIF, PNG, WebP, but not SVG).


## How The Process Works

Let's say you have an image that you'd like to edit.

1. You'll begin by creating a resource that loads the image into memory. This is a copy of the original. Depending on the file type, you might use:

    - `imagecreatefromjpeg()`
    - `imagecreatefrompng()`
    - `imagecreatefromwebp()`

2. From here, you simply run the functions that you need in order to do whatever it is you need to do, such as resizing, cropping, adding filters, adding a watermark, etc. 

3. After making all of your changes, you'll need to save your altered image to file. Your output MIME type (discussed in the next section) does not have to be the same as the original; PHP will make the conversion for you.

4. Finally, after processing images, it's important to free up memory by destroying the image resources. This prevents memory leaks and ensures efficient use of server resources. We can do this with `imagedestroy()`.

    Note: Image resources take up a lot of memory, so if you're working with multiple images, it's important to destroy image resources as soon as they're no longer needed.

The biggest caveat is that everything is done programatically. This means that there is no visual feedback as you're going through the process -- you just have to check the final output.


## A Note On MIME Types
 
MIME (Multipurpose Internet Mail Extensions) types are standardized identifiers used to indicate the nature and format of a file [^1]. They inform browsers and servers how to handle the file data. For example:

  - `image/jpeg` for JPEG images
  - `image/png` for PNG images
  - `image/webp` for WebP images

A comprehensive list of MIME types is maintained by IANA (Internet Assigned Numbers Authority)[^3].

In today's lesson, we'll need to specify a MIME type when outputting an image to the browser. 


---

## Footnotes

[^1]: [Github Site for GD Graphics Library](https://libgd.github.io/)

[^2]: [MIME types (MDN)](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/MIME_types)

[^3]: [Media Types (IANA)](https://www.iana.org/assignments/media-types/media-types.xhtml)