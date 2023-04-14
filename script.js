'use strict'

const eventsSlider = document.querySelector('.events__slider')
const leftArrow = document.querySelector('.leftArrow')
const rightArrow = document.querySelector('.rightArrow')
const lastChild = document.querySelector('.events__slider li:last-child')
const dot1 = document.querySelector('.dot1')
const dot2 = document.querySelector('.dot2')

const eventCards = Array.from(document.querySelectorAll('.event'))
const dotsContainer = document.querySelector('.dots')

eventsSlider.addEventListener('scroll', () => handleScroll())
rightArrow.addEventListener('click', () => slide('next'))
leftArrow.addEventListener('click', () => slide('prev'))

function initializeDots() {
  eventCards.forEach((_el, i) => {
    dotsContainer.insertAdjacentHTML('afterbegin', `<div class="dot"></div>`)
  })
  dotsContainer.firstChild.classList.add('dot--active')
}

function slide(direction) {
  let scrollPosition
  const { scrollLeft, clientWidth } = eventsSlider

  switch (direction) {
    case 'prev':
      scrollPosition = scrollLeft - clientWidth
      break
    case 'next':
    default:
      scrollPosition = scrollLeft + clientWidth
      break
  }

  eventsSlider.scrollTo({
    left: scrollPosition,
    behavior: 'smooth',
  })
}

function isInViewport(element) {
  const rect = element.getBoundingClientRect()
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  )
}

if (isInViewport(lastChild)) {
  rightArrow.classList.add('arrow--disabled')
}

const debounce = (callback, wait) => {
  let timeoutId = null
  return (...args) => {
    window.clearTimeout(timeoutId)
    timeoutId = window.setTimeout(() => {
      callback.apply(null, args)
    }, wait)
  }
}

const handleScroll = debounce((ev) => {
  if (eventsSlider.scrollLeft > 1000) {
    rightArrow.classList.add('arrow--disabled')
  } else if (eventsSlider.scrollLeft < 1000) {
    rightArrow.classList.remove('arrow--disabled')
  }
  if (eventsSlider.scrollLeft > 0) {
    leftArrow.classList.remove('arrow--disabled')
  } else if (eventsSlider.scrollLeft <= 0) {
    leftArrow.classList.add('arrow--disabled')
  }

  eventCards.forEach((el, i) => {
    const currentDot = dotsContainer.children[i]
    if (isInViewport(el)) {
      currentDot.classList.add('dot--active')
    }
    if (!isInViewport(el) && currentDot.classList.contains('dot--active')) {
      currentDot.classList.remove('dot--active')
    }
  })
}, 100)

initializeDots()
