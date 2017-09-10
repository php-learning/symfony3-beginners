    // More info about config & dependencies:
    // - https://github.com/hakimel/reveal.js#configuration
    // - https://github.com/hakimel/reveal.js#dependencies
    Reveal.initialize({
        controls: true,
        progress: true,
        keyboard: true,
        overview: true,
        center: true,
        touch: true,
        history: true,
        fragments: true,
        transition: 'convex',
        dependencies: [
            {src: '../assets/plugin/markdown/marked.js'},
            {src: '../assets/plugin/markdown/markdown.js'},
            {src: '../assets/plugin/notes/notes.js', async: true},
            {
                src: '../assets/plugin/highlight/highlight.js', async: true, callback: function () {
                hljs.initHighlightingOnLoad();
            }
            }
        ]
    });
