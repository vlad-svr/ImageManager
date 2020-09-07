function _createFooter(buttons = []) {
    if (buttons.length === 0) {
        return document.createElement('div')
    }

    function noop() { }

    const wrap = document.createElement('div')
    wrap.classList.add('modal-footer')
    buttons.forEach(btn => {
        const $btn = document.createElement('button');
        $btn.textContent = btn.text;
        $btn.classList.add(`btn`);
        $btn.classList.add(`btn-${btn.style || 'secondary'}`);
        $btn.onclick = btn.handler || noop
        wrap.append($btn);
    })
    return wrap;
}

{/* <button type="button" class="btn btn-outline-primary" data-target="">Удалить</button>
<button type="button" class="btn btn-outline-dark" data-close="true">Отменить</button> */}

function _createModal(options) {
    const DEFAULT_WIDTH = '400px';
    const modal = document.createElement('div');
    modal.classList.add('vmodal');
    modal.insertAdjacentHTML('afterbegin', `
        <div class="modal-overlay" data-close="true">
            <div style="width: ${options.width || DEFAULT_WIDTH}" class="modal-window">
                <div class="modal-header">
                    <span class="modal-title">${options.title || 'Окно'}</span>
                    ${options.closable ? '<span class="modal-close" data-close="true">&times;</span>' : ''}
                </div>
                <div class="modal-body" data-content>
                ${options.content || ''}
                </div>               
            </div>
        </div>
    `)
    const footer = _createFooter(options.footerButtons);
    // console.log(modal.querySelector('[data-content]'))
    modal.querySelector('[data-content]').after(footer)
    // elem.insertAdjacentHTML(where, html)
    document.body.appendChild(modal);
    // document.querySelector('#btnClose').addEventListener('onclick', () => {

    // })
    return modal;
}


$.modal = function (options) {
    const ANIMATION_SPEED = 200
    const $modal = _createModal(options);
    let closing = false;
    let destroyed = false;

    const modal = {
        open() {
            if (destroyed) {
                return console.log('Modal is destroyed');
            }
            !closing && $modal.classList.add('open');

        },
        close() {
            closing = true;
            $modal.classList.remove('open');
            $modal.classList.add('hide');
            setTimeout(() => {
                $modal.classList.remove('hide')
                closing = false;
                if (typeof options.onClose === 'function') options.onClose();
            }, ANIMATION_SPEED);
        }
    }

    const closeListener = e => {
        if (e.target.dataset.close) modal.close();
    }
    const targetListener = e => {
        if (e.target.dataset.target) {
            modal.close();
            return true;
        }
    }

    $modal.addEventListener('click', closeListener)
    $modal.addEventListener('click', targetListener)

    return Object.assign(modal, {
        destroy() {
            $modal.remove();
            $modal.removeEventListener('click', closeListener);
            $modal.removeEventListener('click', targetListener);
            destroyed = true;
        },
        setContent(htmlStr) {
            $modal.querySelector('[data-content]').innerHTML = htmlStr;
        },
    })
}