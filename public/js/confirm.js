$.confirm = function (options) {
    return new Promise((resolve, reject) => {
        const modal = $.modal({
            title: options.title,
            width: '350px',
            closable: false,
            content: options.content,
            onClose() {
                modal.destroy()
            },
            footerButtons: [
                {
                    text: 'Удалить', style: 'primary', handler() {
                        modal.close()
                        resolve()
                    }
                },
                {
                    text: 'Отменить', style: 'outline-dark', handler() {
                        modal.close()
                        reject()
                    }
                }
            ]
        })
        setTimeout(() => modal.open(), 100)
    })
}