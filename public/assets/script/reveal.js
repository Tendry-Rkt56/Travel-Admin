const options = {
     root:null,
     rootMargin:"0px",
     threshold: 0.3,
}

const intersection = function (entries, observer) {
     entries.forEach(entry => {
          if (entry.intersectionRatio > options.threshold) {
               entry.target.classList.add('reveal-visible')
               observer.unobserve(entry.target)
          }
     })
}

const observer = new IntersectionObserver(intersection, options)
document.querySelectorAll("[class*='reveal']").forEach(reveal => {
     observer.observe(reveal)
})

