
export default function scrollToTop(to, from, next) {
    if (from.name == null || to.name == from.name) {
        return next();
    }

    setTimeout(() => {
        window.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    }, 50);

    return next();
}
