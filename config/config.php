<?php

return [
    /**
     * Set the default pdftohtml binary path
     */
    'bin_path' => env('PDF_TO_HTML_PATH', '/usr/bin/pdftohtml'),

    /**
     * Store the .html file into this directory
     */
    'output_dir' => env('PDF_TO_HTML_OUTPUT_DIR', storage_path('app/pdf-to-html')),

    /**
     * Determine embedded image in the HTML result will be base64 data url or external images.
     * The result will be:
     * - true   : <img src="src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgA..." ...>
     * - false  : <img src="src="./document-image-1.png" ...>
     */
    'inline_images' => env('PDF_TO_HTML_INLINE_IMAGES', false),
];
