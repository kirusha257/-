<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас — Ресторан AAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap');
        :root { --gold:#c9a84c; --gold-light:#e8c97a; --gold-dim:rgba(201,168,76,0.1); --bg:#111110; --bg-card:#1c1c1a; --bg-input:#151514; --border:rgba(255,255,255,0.07); --border-gold:rgba(201,168,76,0.3); --text:#e8e4dc; --text-muted:#7a7670; --radius:12px; --radius-sm:7px; }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;padding:36px 28px 60px;}
        .page-wrap{max-width:960px;margin:0 auto;}
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:40px;padding-bottom:22px;border-bottom:1px solid var(--border);}
        .topbar__title{font-family:'Cormorant Garamond',serif;font-size:1.9rem;font-weight:500;color:var(--gold);}
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:32px;}
        .field{display:flex;flex-direction:column;gap:7px;margin-bottom:20px;}
        .field__label{font-size:0.72rem;font-weight:500;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;}
        .btn{display:inline-flex;align-items:center;gap:6px;padding:10px 22px;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:0.875rem;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;}
        .btn--gold{background:var(--gold);color:#0e0d0b;}
        .btn--gold:hover{background:var(--gold-light);transform:translateY(-1px);box-shadow:0 4px 14px rgba(201,168,76,0.25);}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:var(--text-muted);text-decoration:none;font-size:0.8rem;letter-spacing:0.04em;transition:color 0.2s;margin-top:28px;}
        .back-link:hover{color:var(--gold);}
        .back-link::before{content:'←';}
        .hint{font-size:0.78rem;color:var(--text-muted);margin-top:6px;line-height:1.5;}
        .return{margin:-50px 0px 20px 0px}
        
        /* Стили для CKEditor */
        .ck-editor__editable {
            min-height: 300px;
            background: var(--bg-input) !important;
            color: var(--text) !important;
            border: 1px solid var(--border) !important;
        }
        .ck.ck-button, .ck.ck-toolbar {
            background: var(--bg-card) !important;
        }
        .ck.ck-button__label, .ck.ck-icon {
            color: var(--text) !important;
        }
    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div>
                <div class="topbar__title">О нас</div>
            </div>
        </div>
        <div class="return"> 
            <a href="{{ route('admin.dashboard') }}" class="back-link">Вернуться в панель управления</a>
        </div>
        <div class="card">
            <form method="POST" action="{{ route('admin.about.update') }}" id="aboutForm">
                @csrf
                <div class="field">
                    <label class="field__label">Текст раздела "О нас"</label>
                    <textarea name="content" id="editor">{{ $about->content ?? '' }}</textarea>
                    <p class="hint">Этот текст будет отображаться на публичной странице сайта.</p>
                </div>
                <button type="submit" class="btn btn--gold">Сохранить изменения</button>
            </form>
        </div>
    </div>

    <!-- Подключение CKEditor 5 из вашей локальной папки -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    
    <script>
        // Ждем загрузки страницы
        document.addEventListener('DOMContentLoaded', function() {
            // Инициализация CKEditor
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|',
                            'bulletedList', 'numberedList', '|',
                            'alignment', '|',
                            'fontSize', 'fontFamily', 'fontColor', '|',
                            'link', '|',
                            'undo', 'redo'
                        ]
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                        ]
                    },
                    fontSize: {
                        options: [10, 12, 14, 'default', 18, 20, 22, 24, 28, 32, 36, 40]
                    },
                    fontFamily: {
                        options: [
                            'default',
                            'Arial, Helvetica, sans-serif',
                            'Georgia, serif',
                            'Times New Roman, serif',
                            'Verdana, Geneva, sans-serif',
                            'Courier New, Courier, monospace'
                        ]
                    },
                    placeholder: 'Введите текст о ресторане...',
                    language: 'ru'
                })
                .then(editor => {
                    console.log('CKEditor успешно загружен!', editor);
                    
                    // Дополнительно: автоматическое сохранение (опционально)
                    editor.model.document.on('change:data', () => {
                        const data = editor.getData();
                        // Здесь можно добавить автосохранение если нужно
                    });
                })
                .catch(error => {
                    console.error('Ошибка загрузки CKEditor:', error);
                    alert('Ошибка загрузки редактора: ' + error.message + '\nПроверьте путь к файлу ckeditor5.js');
                });
        });
    </script>
</body>
</html>