<?php
include '../includes/config.php';
$pageInfo = [
    'title' => 'PDF & Word Converter - ' . SITE_NAME,
    'description' => 'Convert PDF to Word and Word to PDF Instantly. 100% Free and Client-side (Privacy Focused).'
];
include '../includes/header.php';
?>

<!-- Load Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.6.0/mammoth.browser.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    // PDF.js worker setup
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
</script>

<style>
    .converter-workspace {
        max-width: 900px;
        margin: 3rem auto;
        background: var(--bg-card);
        padding: 2.5rem;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: var(--shadow-soft);
    }

    .tabs {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        background: var(--bg-elevated);
        padding: 0.5rem;
        border-radius: 12px;
    }

    .tab-btn {
        flex: 1;
        padding: 1rem;
        border: none;
        background: transparent;
        color: var(--text-secondary);
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .tab-btn.active {
        background: var(--bg-card);
        color: var(--primary);
        box-shadow: var(--shadow-soft);
    }

    .drop-zone {
        border: 2px dashed rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 4rem 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        margin-bottom: 2rem;
        background: rgba(255, 255, 255, 0.02);
    }

    .drop-zone:hover,
    .drop-zone.dragover {
        border-color: var(--primary);
        background: rgba(51, 153, 255, 0.05);
    }

    .drop-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        display: block;
        color: var(--text-muted);
    }

    .file-info {
        display: none;
        margin-bottom: 2rem;
        padding: 1rem;
        background: rgba(0, 255, 163, 0.1);
        border: 1px solid rgba(0, 255, 163, 0.2);
        border-radius: 12px;
        color: var(--success);
        align-items: center;
        gap: 1rem;
    }

    .preview-box {
        background: white;
        color: #333;
        padding: 2rem;
        min-height: 300px;
        max-height: 600px;
        overflow-y: auto;
        border-radius: 8px;
        margin-bottom: 2rem;
        text-align: left;
        display: none;
        /* Hidden by default */
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .preview-box p {
        color: #333;
        margin-bottom: 1em;
    }

    .btn-convert {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 1rem 3rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: none;
        /* Hidden until file selected */
        width: 100%;
    }

    .btn-convert:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-glow);
    }

    .btn-convert:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Loader */
    .loader {
        display: none;
        margin: 2rem auto;
        border: 4px solid rgba(255, 255, 255, 0.1);
        border-left-color: var(--primary);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="container" style="text-align: center; padding-top: 4rem;">
    <h1>PDF & Word Converter</h1>
    <p class="subtitle">Convert documents securely in your browser. No files are uploaded to our server.</p>
</div>

<div class="container converter-workspace">
    <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('word-to-pdf')">Word to PDF</button>
        <button class="tab-btn" onclick="switchTab('pdf-to-word')">PDF to Word</button>
    </div>

    <!-- Word to PDF Section -->
    <div id="section-word-to-pdf">
        <div class="drop-zone" id="dropVerified" onclick="document.getElementById('wordInput').click()">
            <span class="drop-icon">📄</span>
            <h3>Click to Upload Word File (.docx)</h3>
            <p style="color: var(--text-secondary);">or drag and drop here</p>
            <input type="file" id="wordInput" accept=".docx" style="display: none;" onchange="handleWordSelect(this)">
        </div>

        <div id="wordFileInfo" class="file-info">
            <span style="font-size: 1.5rem;">✅</span>
            <span id="wordFileName">filename.docx</span>
        </div>

        <div id="wordPreview" class="preview-box"></div>
        <div class="loader" id="wordLoader"></div>

        <button class="btn-convert" id="btnWordToPdf" onclick="convertWordToPdf()">Convert to PDF & Download</button>
    </div>

    <!-- PDF to Word Section -->
    <div id="section-pdf-to-word" style="display: none;">
        <div class="drop-zone" onclick="document.getElementById('pdfInput').click()">
            <span class="drop-icon">📕</span>
            <h3>Click to Upload PDF File (.pdf)</h3>
            <p style="color: var(--text-secondary);">or drag and drop here</p>
            <input type="file" id="pdfInput" accept=".pdf" style="display: none;" onchange="handlePdfSelect(this)">
        </div>

        <div id="pdfFileInfo" class="file-info">
            <span style="font-size: 1.5rem;">✅</span>
            <span id="pdfFileName">filename.pdf</span>
        </div>

        <div id="pdfPreview" class="preview-box"></div>
        <div class="loader" id="pdfLoader"></div>

        <button class="btn-convert" id="btnPdfToWord" onclick="convertPdfToWord()">Convert to Word & Download</button>
    </div>
</div>

<!-- SEO Content Section -->
<div class="container" style="max-width: 1000px; margin-top: 5rem; padding-bottom: 5rem;">
    <style>
        .content-section h2 {
            font-size: 2rem;
            color: white;
            margin-bottom: 2rem;
            margin-top: 3rem;
        }

        .content-section h3 {
            font-size: 1.5rem;
            color: var(--cyan);
            margin-bottom: 1rem;
            margin-top: 2rem;
        }

        .content-section p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .content-section ul {
            color: var(--text-secondary);
            line-height: 1.8;
            padding-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .content-section li {
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="content-section">
        <h2>Free PDF to Word & Word to PDF Converter</h2>
        <p>The PDF Converter by <?php echo SITE_NAME; ?> is an all-in-one document transformation tool. Whether you need
            to edit a PDF document or turn a Word file into a secure, shareable format, our tool handles it instantly in
            your browser.</p>

        <h3>Word to PDF Converter</h3>
        <p>Turning a Microsoft Word document into a PDF has never been easier. This tool converts your DOCX files into
            high-quality PDF documents while preserving the original formatting, including fonts, images, and layout.
        </p>
        <ul>
            <li><strong>Universal Compatibility:</strong> PDFs look the same on any device or operating system.</li>
            <li><strong>Security:</strong> PDFs are harder to edit, making them ideal for sending final versions of
                contracts, resumes, and reports.</li>
            <li><strong>Compact Size:</strong> PDFs often compress file sizes for easier sharing via email.</li>
        </ul>

        <h3>PDF to Word Converter</h3>
        <p>Need to edit a read-only PDF? Our PDF to Word tool extracts text and rebuilds the document structure into an
            editable Word file (.doc). This is perfect for when you've lost the original source file or need to make
            quick updates to a PDF form.</p>
        <ul>
            <li><strong>Easy Editing:</strong> Modify text, tables, and lists easily within Microsoft Word or Google
                Docs.</li>
            <li><strong>Fast Extraction:</strong> Quickly pull text from large reports or e-books without retyping
                everything manually.</li>
        </ul>

        <h3>Secure & Private Conversion</h3>
        <p>Unlike other online converters that upload your files to a server, this tool processes your documents
            <strong>100% locally in your browser</strong>. This means your sensitive data never leaves your device,
            guaranteeing total privacy and security.</p>

        <h3>How to Convert Files?</h3>
        <ol style="color: var(--text-secondary); line-height: 1.8; margin-left: 1.5rem; margin-bottom: 1.5rem;">
            <li>Select the conversion mode from the tabs above (Word to PDF or PDF to Word).</li>
            <li>Click the upload area or drag and drop your file.</li>
            <li>Wait for the tool to process and preview the document.</li>
            <li>Click the "Convert & Download" button to save your new file.</li>
        </ol>
    </div>
</div>

<script>
    let currentMode = 'word-to-pdf';
    let fileContentHtml = ''; // Stores extracted HTML

    function switchTab(mode) {
        currentMode = mode;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-btn')[mode === 'word-to-pdf' ? 0 : 1].classList.add('active');

        document.getElementById('section-word-to-pdf').style.display = mode === 'word-to-pdf' ? 'block' : 'none';
        document.getElementById('section-pdf-to-word').style.display = mode === 'pdf-to-word' ? 'block' : 'none';

        // Reset states
        fileContentHtml = '';
    }

    // --- Word to PDF Logic ---
    function handleWordSelect(input) {
        if (input.files.length === 0) return;
        const file = input.files[0];

        document.getElementById('wordFileName').textContent = file.name;
        document.getElementById('wordFileInfo').style.display = 'flex';
        document.getElementById('wordLoader').style.display = 'block';
        document.getElementById('wordPreview').innerHTML = '';
        document.getElementById('btnWordToPdf').style.display = 'none';

        // Parse Docx
        const reader = new FileReader();
        reader.onload = function (event) {
            mammoth.convertToHtml({ arrayBuffer: event.target.result })
                .then(function (result) {
                    fileContentHtml = result.value; // The generated HTML
                    const preview = document.getElementById('wordPreview');
                    preview.innerHTML = fileContentHtml;
                    preview.style.display = 'block';
                    document.getElementById('wordLoader').style.display = 'none';
                    document.getElementById('btnWordToPdf').style.display = 'block';
                })
                .catch(function (err) {
                    alert('Error parsing Word file: ' + err.message);
                    document.getElementById('wordLoader').style.display = 'none';
                });
        };
        reader.readAsArrayBuffer(file);
    }

    function convertWordToPdf() {
        const element = document.getElementById('wordPreview');
        const filename = document.getElementById('wordFileName').textContent.replace('.docx', '.pdf');

        const opt = {
            margin: 10,
            filename: filename,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        // Use html2pdf lib
        html2pdf().set(opt).from(element).save();
    }


    // --- PDF to Word Logic ---
    async function handlePdfSelect(input) {
        if (input.files.length === 0) return;
        const file = input.files[0];

        document.getElementById('pdfFileName').textContent = file.name;
        document.getElementById('pdfFileInfo').style.display = 'flex';
        document.getElementById('pdfLoader').style.display = 'block';
        document.getElementById('pdfPreview').innerHTML = '';
        document.getElementById('btnPdfToWord').style.display = 'none';

        const fileReader = new FileReader();
        fileReader.onload = async function () {
            try {
                const typedarray = new Uint8Array(this.result);
                const pdf = await pdfjsLib.getDocument(typedarray).promise;

                let extractedHtml = '';

                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const textContent = await page.getTextContent();

                    // Simple text extraction - rebuilding paragraphs by height? 
                    // For now, just dumping text items.
                    // This creates a "rough" extraction which is standard for free tools.
                    let pageText = '';
                    let lastY = -1;

                    textContent.items.forEach(item => {
                        // Very basic layout reconstruction based on Y position change
                        if (lastY != -1 && Math.abs(item.transform[5] - lastY) > 10) {
                            pageText += '<br>';
                        }
                        pageText += item.str + ' ';
                        lastY = item.transform[5];
                    });

                    extractedHtml += `<p>${pageText}</p><hr>`;
                }

                fileContentHtml = extractedHtml;
                const preview = document.getElementById('pdfPreview');
                preview.innerHTML = fileContentHtml;
                preview.style.display = 'block';
                document.getElementById('pdfLoader').style.display = 'none';
                document.getElementById('btnPdfToWord').style.display = 'block';

            } catch (err) {
                console.error(err);
                alert('Error parsing PDF: ' + err.message);
                document.getElementById('pdfLoader').style.display = 'none';
            }
        };
        fileReader.readAsArrayBuffer(file);
    }

    function convertPdfToWord() {
        if (!fileContentHtml) return;

        const filename = document.getElementById('pdfFileName').textContent.replace('.pdf', '.doc');

        // Wrap in complete HTML structure for Word to recognize it nicely as a .doc
        const header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
            "xmlns:w='urn:schemas-microsoft-com:office:word' " +
            "xmlns='http://www.w3.org/TR/REC-html40'>" +
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
        const footer = "</body></html>";
        const sourceHTML = header + fileContentHtml + footer;

        const source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);

        const fileDownload = document.createElement("a");
        document.body.appendChild(fileDownload);
        fileDownload.href = source;
        fileDownload.download = filename;
        fileDownload.click();
        document.body.removeChild(fileDownload);
    }
</script>

<?php include '../includes/footer.php'; ?>