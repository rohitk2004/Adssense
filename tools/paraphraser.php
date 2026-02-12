<?php
include '../includes/config.php';
$pageInfo = [
    'title' => 'Free Paraphraser Tool - ' . SITE_NAME,
    'description' => 'Rewrite your content instantly with our free online paraphrasing tool.'
];
include '../includes/header.php';
?>

<style>
    .tool-container {
        max-width: 1000px;
        margin: 0 auto;
        padding-top: 2rem;
    }

    .tool-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .tool-workspace {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        background: var(--bg-card);
        padding: 2rem;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: var(--shadow-soft);
    }

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .input-group label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
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
        font-size: 1rem;
        line-height: 1.6;
        resize: none;
        transition: all 0.3s ease;
    }

    textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 20px rgba(51, 153, 255, 0.1);
    }

    .controls {
        grid-column: 1 / -1;
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding: 1rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin: 1rem 0;
    }

    .btn-action {
        padding: 0.8rem 2rem;
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(51, 153, 255, 0.3);
    }

    .btn-secondary {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--text-secondary);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .tool-workspace {
            grid-template-columns: 1fr;
        }

        textarea {
            height: 250px;
        }
    }
</style>

<div class="container tool-container">
    <div class="tool-header">
        <h1>Free Paraphraser</h1>
        <p class="subtitle">Rewrite your text to improve clarity and uniqueness.</p>
    </div>

    <div class="tool-workspace">
        <div class="input-group">
            <label for="inputText">Original Text</label>
            <textarea id="inputText" placeholder="Paste your text here to paraphrase..."></textarea>
        </div>

        <div class="input-group">
            <label for="outputText">Paraphrased Output</label>
            <textarea id="outputText" readonly placeholder="Your rewritten text will appear here..."></textarea>
        </div>

        <div class="controls">
            <button class="btn-action" onclick="paraphraseText()">
                <span>⚡ Paraphrase Now</span>
            </button>
            <button class="btn-action btn-secondary" onclick="copyResult()">
                <span>📋 Copy Result</span>
            </button>
            <button class="btn-action btn-secondary" onclick="clearAll()">
                <span>🗑️ Clear</span>
            </button>
        </div>
    </div>
</div>

<!-- Load compromise NLP library for smarter tokenization and future PoS tagging features -->
<script src="https://unpkg.com/compromise@latest/builds/compromise.min.js"></script>

<script>
    // Expanded Dictionary for "Stronger" Paraphrasing
    const dictionary = {
        verbs: {
            "use": ["utilize", "leverage", "employ", "apply"],
            "make": ["create", "construct", "fabricate", "generate"],
            "get": ["obtain", "acquire", "procure", "secure"],
            "help": ["assist", "aid", "facilitate", "support"],
            "look": ["examine", "inspect", "observe", "analyze"],
            "want": ["desire", "crave", "seek", "aspire to"],
            "need": ["require", "demand", "necessitate"],
            "think": ["believe", "consider", "contemplate", "regard"],
            "say": ["state", "declare", "articulate", "mention"],
            "tell": ["inform", "notify", "apprise", "advise"],
            "ask": ["inquire", "request", "query", "solicit"],
            "go": ["depart", "proceed", "move", "advance"],
            "come": ["arrive", "appear", "approach"],
            "buy": ["purchase", "acquire", "invest in"],
            "sell": ["vend", "market", "distribute"],
            "find": ["discover", "locate", "uncover", "detect"],
            "change": ["modify", "alter", "transform", "adjust"],
            "start": ["initiate", "commence", "launch", "begin"],
            "stop": ["halt", "cease", "terminate", "discontinue"],
            "write": ["compose", "draft", "author", "document"],
            "read": ["peruse", "scan", "review"],
            "show": ["demonstrate", "display", "exhibit", "reveal"],
            "give": ["provide", "grant", "offer", "deliver"]
        },
        adjectives: {
            "good": ["excellent", "superb", "exceptional", "superior"],
            "bad": ["suboptimal", "inferior", "unfavorable", "adverse"],
            "happy": ["delighted", "elated", "joyful", "content"],
            "sad": ["melancholy", "sorrowful", "despondent"],
            "fast": ["rapid", "swift", "expeditious", "quick"],
            "slow": ["sluggish", "leisurely", "gradual"],
            "big": ["substantial", "significant", "massive", "considerable"],
            "small": ["diminutive", "compact", "minor", "slight"],
            "easy": ["effortless", "straightforward", "simple"],
            "hard": ["challenging", "arduous", "demanding", "complex"],
            "important": ["crucial", "vital", "essential", "critical"],
            "new": ["innovative", "novel", "modern", "fresh"],
            "old": ["vintage", "antiquated", "established", "classic"],
            "great": ["magnificent", "terrific", "splendid"],
            "different": ["distinct", "diverse", "varied", "unique"],
            "same": ["identical", "equivalent", "corresponding"],
            "many": ["numerous", "countless", "various", "multiple"]
        },
        adverbs: {
            "very": ["extremely", "exceedingly", "utterly", "highly"],
            "really": ["truly", "genuinely", "actually"],
            "quickly": ["rapidly", "swiftly", "promptly"],
            "slowly": ["gradually", "leisurely", "steadily"],
            "often": ["frequently", "repeatedly", "regularly"],
            "never": ["by no means", "not once", "under no circumstances"]
        },
        phrases: {
            "in conclusion": "to summarize",
            "on the other hand": "conversely",
            "as a result": "consequently",
            "for example": "for instance",
            "in addition": "furthermore",
            "a lot of": "a plethora of",
            "first of all": "primarily",
            "due to the fact that": "since",
            "in order to": "to",
            "keep in mind": "remember",
            "point of view": "perspective"
        }
    };

    function paraphraseText() {
        const input = document.getElementById('inputText').value;
        const output = document.getElementById('outputText');

        if (!input.trim()) {
            alert('Please enter some text first.');
            return;
        }

        output.value = "Analyzing and rewriting...";

        // Use Compromise NLP for processing
        setTimeout(() => {
            let doc = nlp(input);
            let text = input;

            // 1. Phrase Replacement (Simple String Replacement first as it's safer)
            // We do this before NLP token replacement to capture longer strings
            for (const [phrase, replacement] of Object.entries(dictionary.phrases)) {
                const regex = new RegExp(`\\b${phrase}\\b`, 'gi');
                text = text.replace(regex, (match) => {
                    // Preserve capitalization of the first letter
                    if (match[0] === match[0].toUpperCase()) {
                        return replacement.charAt(0).toUpperCase() + replacement.slice(1);
                    }
                    return replacement;
                });
            }

            // Re-process with NLP after phrase changes
            doc = nlp(text);

            // 2. Smart Word Replacement using NLP tags
            // Iterate through terms to find matches in our dictionary
            doc.compute('root'); // Compute root forms (e.g., "running" -> "run")

            doc.termList().forEach(term => {
                const normal = term.normal; // normalized straight text
                const root = term.root || normal;
                let replacement = null;

                // Check Adjectives
                if (dictionary.adjectives[normal] || dictionary.adjectives[root]) {
                    const options = dictionary.adjectives[normal] || dictionary.adjectives[root];
                    replacement = options[Math.floor(Math.random() * options.length)];
                }
                // Check Verbs
                else if (dictionary.verbs[normal] || dictionary.verbs[root]) {
                    // For verbs, we need to be careful with tense. 
                    // Compromise can help conjugate, but for now we'll stick to simple swaps
                    // or try to match the suffix
                    const options = dictionary.verbs[normal] || dictionary.verbs[root];
                    const baseReplacement = options[Math.floor(Math.random() * options.length)];

                    // Very basic conjugation matching
                    if (term.text.endsWith('ing')) {
                        // simplistic - assumes replacement is regular
                        // ideally use nlp(baseReplacement).verbs().toGerund().text()
                        // but let's trust compromise's conjugation if we can
                        replacement = nlp(baseReplacement).verbs().toGerund().text();
                    } else if (term.text.endsWith('ed')) {
                        replacement = nlp(baseReplacement).verbs().toPastTense().text();
                    } else if (term.text.endsWith('s') && !term.text.endsWith('ss')) {
                        replacement = nlp(baseReplacement).verbs().toPresentTense().text();
                    } else {
                        replacement = baseReplacement;
                    }
                }
                // Check Adverbs
                else if (dictionary.adverbs[normal] || dictionary.adverbs[root]) {
                    const options = dictionary.adverbs[normal] || dictionary.adverbs[root];
                    replacement = options[Math.floor(Math.random() * options.length)];
                }

                // Apply replacement if found
                if (replacement) {
                    // Handle Capitalization
                    if (term.text[0] === term.text[0].toUpperCase()) {
                        replacement = replacement.charAt(0).toUpperCase() + replacement.slice(1);
                    }

                    // We replace the specific text occurrence
                    // Note: Global replace might be dangerous if word appears twice with different meanings
                    // Ideally we replace by index, but for this "Stronger" version, string replace is acceptable
                    // to avoid complex index tracking hell in a simple script.
                    // We use a regex with word boundaries to avoid replacing substrings.
                    const regex = new RegExp(`\\b${term.text}\\b`);
                    text = text.replace(regex, replacement);
                }
            });

            output.value = text;
        }, 800);
    }

    function copyResult() {
        const output = document.getElementById('outputText');
        output.select();
        document.execCommand('copy');
        alert('Copied to clipboard!');
    }

    function clearAll() {
        document.getElementById('inputText').value = '';
        document.getElementById('outputText').value = '';
    }
</script>

<?php include '../includes/footer.php'; ?>