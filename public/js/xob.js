// https://john-dugan.com/javascript-debounce/
function debounce(e, t, n) {
    var a;
    return function () {
        var r = this,
            i = arguments,
            o = function () {
                a = null, n || e.apply(r, i)
            },
            s = n && !a;
        clearTimeout(a), a = setTimeout(o, t || 200), s && e.apply(r, i)
    }
}

const texts = [
    '<h1>THE STATE OF CIVIL<br> SOCIETY IN LEBANON\n</h1><h3>A PILOT MAPPING STUDY MARCH 2021</h3>',
    '<h3>The cry for economic and civic rights first caught the world’s attention in early 2011 as the narrative of the Arab Spring originated from the squares and markets in Sidi Bouzid, Tunisia, and Tahrir Square, Cairo, Egypt. The popular outcries against poverty and authoritarianism spread to Iraq, Algeria, Bahrain, Libya, Syria, and other countries far and near, triggering civil unrest, mass protests, modifications of political systems and regime changes, as well as protracted armed confrontations and totalitarian backlashes.\n</h3>',
    '<h3>There were periods of post-conflict reconstruction where the role of civil organizations was less visible when compared with the last ten years. Correlated with the regional uprisings and several national crises since 2011, however, a new generation of local CSOs has come into existence. The greatest cohort of this new generation of CSOs mushroomed in the space of a few weeks after October 17, 2019, at the time of popular protests that were initially triggered by outrage over proposed tax levies on interpersonal smartphone communication.\n</h3>',
    '<h3>Ignited by spontaneous protests against this “WhatsApp tax” in the downtown government district of Beirut, waves of more or less spontaneous uprising took important public squares in Beirut  by storm and also washed over suburban districts to the north of the Lebanese capital. The wave then quickly engulfed outlying townships and population centers, prominently including the second city of Tripoli where the Sahet El Nour square saw mass gatherings.\n</h3>',
    '<h3>At this stage of the 2019 uprising, communal barriers were swept away by peaceful human chains, activism from various political backgrounds was invigorated, new CSOs were born, old political factions were revived, and the entire generation of post-2011, Arab Spring-inspired, CSOs experienced a rejuvenation.\n</h3>',
    '<h3>The following dashboards were derived by “The Pulse” from a countrywide mapping and surveying study that has been supported by German Konrad Adenauer Foundation. The results of the study are detailed in <a style="color:#000;" href="storage/downloads/The_State_of_Civil_Society_in_Lebanon.pdf" >the following link</a> revealing a qualitative analysis and a data segment with profile information and survey responses from 85 notable CSOs.\n</h3>',
    '<a href="/general-information" class="button">Dashboard</a>',
]

const stepSize = window.innerHeight

function setText(contentTag, text) {
    contentTag.innerHTML = text
}

function getIndex(distance, stepSize) {
    return parseInt(distance / stepSize)
}

function getText(texts, index) {
    return texts[index] ? texts[index] : 'no text found :('
}

function changeText(contentTag, stepSize, texts) {
    const distance = window.scrollY
    const index = getIndex(distance, stepSize)
    const text = getText(texts, index)
    setText(contentTag, text)
}

function setInittext(contentTag, texts) {
    const text = getText(texts, 0)
    setText(contentTag, text)
}

window.onload = function() {
    const contentTag = document.querySelector('#content')
    setInittext(contentTag, texts)
    window.addEventListener('scroll', debounce(() => { changeText(contentTag, stepSize, texts) }, 20))
}
