export default function copy() {
    const copyButtons = [...document.querySelectorAll('[data-copy]')]
    copyButtons.length && copyButtons.forEach(link => {
        link.addEventListener('click', async (evt) => {
            evt.preventDefault()
            await navigator.clipboard.writeText(evt.currentTarget.dataset.copy)
        })
    })
}