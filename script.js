'use strict'

const eventsSlider = document.querySelector('.events__slider')
const leftArrow = document.querySelector('.leftArrow')
const rightArrow = document.querySelector('.rightArrow')
const firstChild = document.querySelector('.events__slider li:first-child')
const lastChild = document.querySelector('.events__slider li:last-child')
const eventCards = Array.from(document.querySelectorAll('.event'))
const dotsContainer = document.querySelector('.dots')

const form = document.querySelector('.wpcf7-form')
const mediaQueryLarge = window.matchMedia('(min-width: 800px)')
const mediaQuerySmall = window.matchMedia('(max-width: 600px)')

if (eventsSlider) {
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
    if (isInViewport(firstChild)) {
      leftArrow.classList.add('arrow--disabled')
    }
    if (!isInViewport(firstChild)) {
      leftArrow.classList.remove('arrow--disabled')
    }
    if (isInViewport(lastChild)) {
      rightArrow.classList.add('arrow--disabled')
    }
    if (!isInViewport(lastChild)) {
      rightArrow.classList.remove('arrow--disabled')
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

  if (isInViewport(lastChild)) {
    rightArrow.classList.add('arrow--disabled')
  }

  initializeDots()
}

if (form) {
  const button = document.querySelector('.wpcf7-submit')
  button.classList.add('btn')
}
