<?php
include '../includes/config.php';
$pageInfo = [
    'title' => 'Free Word Counter Tool - ' . SITE_NAME,
    'description' => 'Count words, characters, sentences, and paragraphs in real-time. Calculate reading time and speaking time.'
];
include '../includes/header.php';
?>

<style>
    .tool-workspace {
        max-width: 1000px;
        margin: 3rem auto;
        background: var(--bg-card);
        padding: 2rem;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: var(--shadow-soft);
    }

    .stats-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
        background: var(--bg-elevated);
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .stat-box {
        text-align: center;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
        display: block;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    textarea {
        width: 100%;
        height: 400px;
        background: var(--bg-elevated);
        border: 2px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1.5rem;
        color: var(--text-primary);
        font-family: inherit;
        font-size: 1.1rem;
        line-height: 1.6;
        resize: vertical;
        transition: all 0.3s ease;
    }

    textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 20px rgba(51, 153, 255, 0.1);
    }

    .meta-info {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
        color: var(--text-muted);
        font-size: 0.95rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-icon {
        color: var(--cyan);
    }

    .controls {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 1.5rem;
    }

    .btn-action {
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: transparent;
        color: var(--text-secondary);
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        border-color: var(--text-primary);
    }

    .btn-clear {
        margin-left: auto;
        border-color: rgba(255, 100, 100, 0.3);
        color: rgba(255, 100, 100, 0.8);
    }

    .btn-clear:hover {
        background: rgba(255, 100, 100, 0.1);
        border-color: rgba(255, 100, 100, 0.8);
        color: #ff6b6b;
    }
</style>

<div class="container" style="text-align: center; padding-top: 4rem;">
    <h1>Word Counter</h1>
    <p class="subtitle">Real-time stats for your content: words, characters, reading time, and more.</p>
</div>

<div class="container tool-workspace">
    <div class="stats-bar">
        <div class="stat-box">
            <span class="stat-value" id="wordCount">0</span>
            <span class="stat-label">Words</span>
        </div>
        <div class="stat-box">
            <span class="stat-value" id="charCount">0</span>
            <span class="stat-label">Characters</span>
        </div>
        <div class="stat-box">
            <span class="stat-value" id="sentenceCount">0</span>
            <span class="stat-label">Sentences</span>
        </div>
        <div class="stat-box">
            <span class="stat-value" id="paraCount">0</span>
            <span class="stat-label">Paragraphs</span>
        </div>
    </div>

    <textarea id="textInput" placeholder="Start typing or paste your text here to analyze..." autofocus></textarea>

    <div class="meta-info">
        <div class="meta-item">
            <span class="meta-icon">⏱️</span>
            Reading Time: <strong id="readingTime" style="margin-left: 5px; color: var(--text-primary);">0 min</strong>
        </div>
        <div class="meta-item">
            <span class="meta-icon">🗣️</span>
            Speaking Time: <strong id="speakingTime" style="margin-left: 5px; color: var(--text-primary);">0
                min</strong>
        </div>
    </div>

    <div class="controls">
        <button class="btn-action" onclick="copyText()">Copy Text</button>
        <button class="btn-action btn-clear" onclick="clearText()">Clear All</button>
    </div>
</div>

<script>
    const textInput = document.getElementById('textInput');
    const wordCountDisplay = document.getElementById('wordCount');
    const charCountDisplay = document.getElementById('charCount');
    const sentenceCountDisplay = document.getElementById('sentenceCount');
    const paraCountDisplay = document.getElementById('paraCount');
    const readingTimeDisplay = document.getElementById('readingTime');
    const speakingTimeDisplay = document.getElementById('speakingTime');

    textInput.addEventListener('input', updateStats);

    function updateStats() {
        const text = textInput.value;

        // Character Count
        charCountDisplay.textContent = text.length;

        // Word Count
        // Match non-whitespace sequences
        const words = text.trim() === '' ? [] : text.trim().split(/\s+/);
        const wordCount = words.length;
        wordCountDisplay.textContent = wordCount;

        // Sentence Count
        // Split by ., !, ? followed by space or end of string
        // Simple approximation
        const sentences = text.split(/[.!?]+/).filter(s => s.trim().length > 0);
        sentenceCountDisplay.textContent = sentences.length;

        // Paragraph Count
        // Split by 2 or more newlines
        const paragraphs = text.split(/\n\s*\n/).filter(p => p.trim().length > 0);
        // If text is empty, 0 paragraphs, else at least 1 if not empty
        paraCountDisplay.textContent = (text.trim() === '') ? 0 : (text.split(/\n+/).filter(line => line.trim().length > 0).length);

        // Reading Time (Average 200 wpm)
        const readTime = Math.ceil(wordCount / 200);
        readingTimeDisplay.textContent = readTime + (readTime === 1 ? ' min' : ' mins');

        // Speaking Time (Average 130 wpm)
        const speakTime = Math.ceil(wordCount / 130);
        speakingTimeDisplay.textContent = speakTime + (speakTime === 1 ? ' min' : ' mins');
    }

    function copyText() {
        textInput.select();
        document.execCommand('copy');
        // Flash effect or toast could go here
    }

    function clearText() {
        textInput.value = '';
        updateStats();
        textInput.focus();
    }
</script>

<?php include '../includes/footer.php'; ?>