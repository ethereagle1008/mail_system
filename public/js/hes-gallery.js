/*!

	HesGallery v1.4.11

	Copyright (c) 2018-2019 Artur Medrygal <medrygal.artur@gmail.com>

	Product under MIT licence

*/

const HesGallery = {
  options: {
    // Default settings

    // Global
    disableScrolling: false,
    hostedStyles: true,
    animations: true,
    keyboardControl: true,
    minResolution: 0,
    autoInit: true,

    // Local
    wrapAround: false,
    showImageCount: true
  },
  version: '1.4.11'
}

function HesSingleGallery(index, root) {
  this.root = root
  this.index = index
  this.imgPaths = []
  this.subTexts = []
  this.altTexts = []
  this.sourceTexts = []
  this.capturePaths = [];
  this.topPaths = [];
  this.originalIndexs = [];

  this.options = {}

  let gallery = document.getElementsByClassName('hes-gallery')[this.index]

  this.options.wrapAround = gallery.hasAttribute('data-wrap') ? gallery.dataset.wrap == 'true' : this.root.options.wrapAround ;
  this.options.showImageCount = gallery.hasAttribute('data-img-count') ? gallery.dataset.imgCount == 'true' : this.root.options.showImageCount;

  let disabledCount = 0
  gallery.querySelectorAll('img').forEach((image, i) => {
    if (image.hasAttribute('data-disabled')) disabledCount++
    else {
      if (image.hasAttribute('data-fullsize')) this.imgPaths.push(image.dataset.fullsize || '')
      else this.imgPaths.push(image.src || '')
      this.subTexts.push(image.dataset.subtext || '')
      this.altTexts.push(image.alt || '')
      this.sourceTexts.push(image.dataset.source || '')
  	  this.capturePaths.push(image.dataset.capture || '');
      this.topPaths.push(image.dataset.top || '');
      this.originalIndexs.push(image.dataset.index || '')

      // image.setAttribute('onclick', `HesGallery.show(${this.index},${i - disabledCount})`)
      image.onclick = () => {
        this.root.show(this.index, i - disabledCount)
      }
    }
  })


  this.count = this.imgPaths.length
}

HesGallery.setOptions = function(values = {}) {
  for (let key in values) this.options[key] = values[key]
}

HesGallery.init = function(options) {
  this.setOptions(options)

  if (!this.executed)
    this.createDOM()

  if (this.options.animations) this.elements.pic_cont.classList = 'hg-transition'
  else this.elements.pic_cont.classList = ''

  this.count = document.querySelectorAll('.hes-gallery').length

  this.galleries = []

  for (let i = 0; i < this.count; i++) {
    // Creates a galleries
    this.galleries[i] = new HesSingleGallery(i, this)
  }

  // KeyDown event listener
  if (this.options.keyboardControl && !this.keydownEventListener) {
    addEventListener('keydown', ({ keyCode }) => {
      if (keyCode == 39 && this.open && this.options.keyboardControl) this.next()
      if (keyCode == 37 && this.open && this.options.keyboardControl) this.prev()
      if (keyCode == 27 && this.open && this.options.keyboardControl) this.hide()
    })
    this.keydownEventListener = true
  }

  return 'HesGallery initiated!'
}

HesGallery.createDOM = function() {
  // Creates DOM Elements for gallery
  this.elements = {}

  if (this.options.hostedStyles) document.head.innerHTML += "<link rel='stylesheet' href='https://unpkg.com/hes-gallery/dist/hes-gallery.min.css'>"

  const gal = document.createElement('div')
  gal.id = 'hgallery'
  gal.setAttribute('style', 'visibility:hidden;')

  this.elements.galery = gal // Whole gallery

  this.elements.galery.innerHTML += `
    <div id='hg-bg'></div>
    <div id='hg-pic-cont'>
       <div id="hg-top" class="text-small-xs text-white w-100" >
           <div class="float-right  " style="margin-right: .5rem" >
                <img class="img-icon height-1" id='hg-top-image'> 
            </div>
        </div>
        <div class="position-relative">
            <img id='hg-pic' />
            <div class="text-small-xs text-white w-100"  id='hg-capture'>
                <div class="float-right  d-flex" style="margin-right: 1rem">
                    <img class="img-icon height-1" id='hg-capture-image'> <p class="hit-the-floor " id='hg-source'> </p>
                </div>
            </div>
        </div>
      
      <div id='hg-prev-onpic'></div>
      <div id='hg-next-onpic'></div>
      <div id='hg-subtext'></div>
      <div id='hg-howmany'></div>
    </div>
    <button id='hg-prev'></button>
    <button id='hg-next'></button>
  `

  document.body.appendChild(gal)

  this.elements.b_prev = document.getElementById('hg-prev')
  this.elements.b_next = document.getElementById('hg-next')

  this.elements.pic_cont = document.getElementById('hg-pic-cont')

  this.elements.b_next_onpic = document.getElementById('hg-next-onpic')
  this.elements.b_prev_onpic = document.getElementById('hg-prev-onpic')

  this.elements.b_prev.onclick = this.elements.b_prev_onpic.onclick = () => {
    this.prev()
  }

  this.elements.b_next.onclick = this.elements.b_next_onpic.onclick = () => {
    this.next()
  }

  document.getElementById('hg-bg').onclick = () => {
    this.hide()
  }

  this.executed = true
}

HesGallery.show = function(g, i) {
  if (innerWidth < this.options.minResolution) return false // If browser width is less than min resolution in settings

  this.currentImg = i
  this.currentGal = g

  this.open = true

  if (this.options.animations || this.elements.pic_cont.classList == 'hg-transition') this.elements.pic_cont.classList.remove('hg-transition')

  document.getElementById('hg-pic').setAttribute('src', this.galleries[g].imgPaths[i]) // Sets the path to image

  document.getElementById('hg-pic').alt = this.galleries[g].altTexts[i] // Sets alt attribute

  this.elements.galery.classList.add('open')

  document.getElementById('hg-subtext').innerHTML = this.galleries[g].subTexts[i]
  if(!this.galleries[g].sourceTexts[i] || this.galleries[g].sourceTexts[i] === "") {

  	  document.getElementById('hg-capture').style.visibility = 'hidden'
    } else {
  	  document.getElementById('hg-capture-image').setAttribute('src', this.galleries[g].capturePaths[i])
  	  document.getElementById('hg-capture').style.visibility = 'visible'
  	  document.getElementById('hg-source').innerHTML = this.galleries[g].sourceTexts[i]
  }
    if(!this.galleries[g].topPaths[i] || this.galleries[g].topPaths[i] === "") {

        document.getElementById('hg-top').style.visibility = 'hidden'
    } else {
        document.getElementById('hg-top-image').setAttribute('src', this.galleries[g].topPaths[i])
        document.getElementById('hg-top').style.visibility = 'visible'

    }

  if (this.galleries[this.currentGal].options.showImageCount && this.galleries[this.currentGal].imgPaths.length != 1)
    document.getElementById('hg-howmany').innerHTML = `${this.currentImg + 1}/${this.galleries[g].count}`
  else
    document.getElementById('hg-howmany').innerHTML = ''

  // Visibility of next/before buttons in gallery
  if (this.galleries[this.currentGal].imgPaths.length == 1) {
    // One image in gallery
    this.elements.b_prev.classList = 'hg-unvisible'
    this.elements.b_prev_onpic.classList = 'hg-unvisible'
    this.elements.b_next.classList = 'hg-unvisible'
    this.elements.b_next_onpic.classList = 'hg-unvisible'
  } else if (this.currentImg + 1 == 1 && !this.galleries[this.currentGal].options.wrapAround) {
    // First photo
    this.elements.b_prev.classList = 'hg-unvisible'
    this.elements.b_prev_onpic.classList = 'hg-unvisible'

    this.elements.b_next.classList = ''
    this.elements.b_next_onpic.classList = ''
  } else if (this.currentImg + 1 == this.galleries[this.currentGal].count && !this.galleries[this.currentGal].options.wrapAround) {
    // Last photo
    this.elements.b_next.classList = 'hg-unvisible'
    this.elements.b_next_onpic.classList = 'hg-unvisible'

    this.elements.b_prev.classList = ''
    this.elements.b_prev_onpic.classList = ''
  } else {
    //Dowolne zdjęcie
    this.elements.b_next.classList = ''
    this.elements.b_next_onpic.classList = ''

    this.elements.b_prev.classList = ''
    this.elements.b_prev_onpic.classList = ''
  }

  if (this.options.disableScrolling) document.body.classList += ' hg-disable-scrolling' // Disable scroll
}

HesGallery.hide = function() {
  if (this.options.animations) this.elements.pic_cont.classList.add('hg-transition')

  this.elements.galery.classList.remove('open')
  this.open = false
  if (this.options.disableScrolling) document.body.classList.remove('hg-disable-scrolling') // Enable scroll
}

HesGallery.next = function() {
  if (this.galleries[this.currentGal].options.wrapAround && this.currentImg == this.galleries[this.currentGal].count - 1) this.show(this.currentGal, 0)
  else if (this.currentImg + 1 < this.galleries[this.currentGal].count) this.show(this.currentGal, this.currentImg + 1)
}

HesGallery.prev = function() {
  if (this.galleries[this.currentGal].options.wrapAround && this.currentImg == 0) this.show(this.currentGal, this.galleries[this.currentGal].count - 1)
  else if (this.currentImg + 1 > 1) this.show(this.currentGal, this.currentImg - 1)
}

HesGallery.changeTopImage = function(index, value) {
    this.galleries[this.currentGal].topPaths[index] = value;
}

document.addEventListener('DOMContentLoaded', () => {
  if(HesGallery.options.autoInit)
    HesGallery.init()
})

if ('object' == typeof exports && 'undefined' != typeof module)
	module.exports = HesGallery

// NodeList polyfill
if (typeof NodeList !== 'undefined' && NodeList.prototype && !NodeList.prototype.forEach) {
  NodeList.prototype.forEach = Array.prototype.forEach
}
