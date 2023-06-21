const music = new Audio(); 
fetch('get_songs.php')
  .then(response => response.json())
  .then(songs => {
    Array.from(document.getElementsByClassName('songItem')).forEach((element, i) => {
      element.getElementsByTagName('img')[0].src = songs[i].poster;
      element.getElementsByTagName('h5')[0].innerHTML = songs[i].songName;
    });
    index = 0;
    const playSong = (index) => {
      music.src = songs[index].musicSrc;
      poster_master_play.src = songs[index].poster;
      title.innerHTML = songs[index].songName;
      music.pause();
      masterPlay.classList.remove('bi-pause-fill');
      masterPlay.classList.add('bi-play-fill');
      makeAllPlays();
      makeAllBackgrounds();
      Array.from(document.getElementsByClassName('playListPlay'))[index].classList.remove('bi-pause-circle-fill');
      Array.from(document.getElementsByClassName('playListPlay'))[index].classList.add('bi-play-circle-fill');
      Array.from(document.getElementsByClassName('songItem')).forEach((element, i) => {
        if (i === index) {
          element.style.background = "rgb(105, 105, 170, .1)";
        } else {
          element.style.background = "";
        }
      });
    };
    playSong(0);
    const songItems = Array.from(document.getElementsByClassName('card'));
    songItems.forEach((element, i) => {
      element.addEventListener('click', () => {
        playSong(i);
        music.play();
        masterPlay.classList.remove('bi-play-fill');
        masterPlay.classList.add('bi-pause-fill');
        wave.classList.add('active2');
      });
    });
    const playlistItems = Array.from(document.getElementsByClassName('songItem'));
    playlistItems.forEach((element, i) => {
      element.addEventListener('click', () => {
        playSong(i);
        music.play();
        masterPlay.classList.remove('bi-play-fill');
        masterPlay.classList.add('bi-pause-fill');
        wave.classList.add('active2');
      });
    });
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', () => {
      const searchText = searchInput.value.toLowerCase();
      if (searchText === '') {
        // Приховати результати пошуку, якщо поле порожнє
        Array.from(document.getElementsByClassName('card')).forEach((element) => {
          element.style.display = 'none';
        });
      } else {
        // Виконати пошук та відображення результатів
        Array.from(document.getElementsByClassName('card')).forEach((element) => {
          const cardContent = element.getElementsByClassName('content')[0];
          const songName = cardContent.firstChild.textContent.toLowerCase();
          if (songName.includes(searchText)) {
            element.style.display = 'inline-block'; // Встановити властивість display в inline-block
          } else {
            element.style.display = 'none';
          }
        });
      }
    });
    // створити слухачі подій для попередніх і наступних кнопок
    const back = document.getElementById('back');
    const next = document.getElementById('next');
    back.addEventListener('click', ()=>{
        index -= 1;
        if (index < 0) {
            index = Array.from(document.getElementsByClassName('songItem')).length - 1;
        }
        playSong(index);
        music.play();
        masterPlay.classList.remove('bi-play-fill');
        masterPlay.classList.add('bi-pause-fill');
        wave.classList.add('active2');
    });
    next.addEventListener('click', ()=>{
        index += 1;
        if (index > Array.from(document.getElementsByClassName('songItem')).length - 1) {
            index = 0;
        }
        playSong(index);
        music.play();
        masterPlay.classList.remove('bi-play-fill');
        masterPlay.classList.add('bi-pause-fill');
        wave.classList.add('active2');
    });
    const next_music = () => {
      if (index == songs.length) {
        index = 0; // Скидання index до 0
      } else {
        index++;
      }
        makeAllPlays();
        // Встановити src аудіо на обрану пісню
        music.src = songs[index].musicSrc;
        poster_master_play.src = songs[index].poster;
        title.innerHTML = songs[index].songName;
      if (music.readyState > 0) {
        masterPlay.classList.remove('bi-play-fill');
        masterPlay.classList.add('bi-pause-fill');
        wave.classList.add('active2');
      }
        makeAllBackgrounds();
        Array.from(document.getElementsByClassName('songItem'))[index - 1].style.background = "";
        Array.from(document.getElementsByClassName('songItem'))[index].style.background = "rgb(105, 105, 170, .1)";
        music.play();
        masterPlay.classList.remove('bi-play-fill');
        masterPlay.classList.add('bi-pause-fill');
}
const repeat_music = () => {
      index;
      makeAllPlays();
      music.src = songs[index].musicSrc;
      poster_master_play.src = songs[index].poster;
      title.innerHTML = songs[index].songName;
    if (music.readyState > 0) {
      masterPlay.classList.remove('bi-play-fill');
      masterPlay.classList.add('bi-pause-fill');
      wave.classList.add('active2');
    }
      makeAllBackgrounds();
      Array.from(document.getElementsByClassName('songItem'))[index - 1].style.background = "";
      Array.from(document.getElementsByClassName('songItem'))[index].style.background = "rgb(105, 105, 170, .1)";
      music.play();
      masterPlay.classList.remove('bi-play-fill');
      masterPlay.classList.add('bi-pause-fill');
}
const random_music = () => {
    if (index == songs.length) {
        index = 0
    } else {
        index = Math.floor((Math.random() * songs.length) + 1);
    }
      makeAllPlays();
      music.src = songs[index].musicSrc;
      poster_master_play.src = songs[index].poster;
      title.innerHTML = songs[index].songName;
    if (music.readyState > 0) {
      masterPlay.classList.remove('bi-play-fill');
      masterPlay.classList.add('bi-pause-fill');
      wave.classList.add('active2');
    }
      makeAllBackgrounds();
      Array.from(document.getElementsByClassName('songItem'))[index - 1].style.background = "";
      Array.from(document.getElementsByClassName('songItem'))[index].style.background = "rgb(105, 105, 170, .1)";
      music.play();
      masterPlay.classList.remove('bi-play-fill');
      masterPlay.classList.add('bi-pause-fill');
}
music.addEventListener('ended', ()=>{
    let b = shuffle.innerHTML;
    switch (b) {
        case 'repeat':
            repeat_music();
            break;
        case 'next':
            next_music();
            break;
        case 'random':
            random_music();
            break;
    }
})
});
let masterPlay = document.getElementById('masterPlay');
let wave = document.getElementsByClassName('wave')[0];
masterPlay.addEventListener('click',()=>{
    if (music.paused || music.currentTime <=0) {
        music.play();
        masterPlay.classList.remove('bi-play-fill');
        masterPlay.classList.add('bi-pause-fill');
        wave.classList.add('active2');
    } else {
        music.pause();
        masterPlay.classList.add('bi-play-fill');
        masterPlay.classList.remove('bi-pause-fill');
        wave.classList.remove('active2');
    }
} )
const makeAllPlays = () =>{
    Array.from(document.getElementsByClassName('playListPlay')).forEach((element)=>{
            element.classList.add('bi-play-circle-fill');
            element.classList.remove('bi-pause-circle-fill');
    })
}
const makeAllBackgrounds = () =>{
    Array.from(document.getElementsByClassName('songItem')).forEach((element)=>{
            element.style.background = "rgb(105, 105, 170, 0)";
    })
}
let poster_master_play = document.getElementById('poster_master_play');
let title = document.getElementById('title');
Array.from(document.getElementsByClassName('playListPlay')).forEach((element)=>{
    element.addEventListener('click', (e)=>{
          index = parseInt(e.target.id); // оновити індекс
          makeAllPlays();
          e.target.classList.remove('bi-play-circle-fill');
          e.target.classList.add('bi-pause-circle-fill');
          // встановити src аудіо для вибраної пісні
          music.src = songs[index-1].musicSrc;
          poster_master_play.src = songs[index-1].poster;
          title.innerHTML = songs[index-1].songName;
        if (music.readyState > 0) {
          masterPlay.classList.remove('bi-play-fill');
          masterPlay.classList.add('bi-pause-fill');
          wave.classList.add('active2');
        }
        music.addEventListener('ended',()=>{
          masterPlay.classList.add('bi-play-fill');
          masterPlay.classList.remove('bi-pause-fill');
          wave.classList.remove('active2');
        })
          makeAllBackgrounds();
          Array.from(document.getElementsByClassName('songItem'))[`${index-1}`].style.background = "rgb(105, 105, 170, .1)";
    })
})
let currentStart = document.getElementById('currentStart');
let currentEnd = document.getElementById('currentEnd');
let seek = document.getElementById('seek');
let bar2 = document.getElementById('bar2');
let dot = document.getElementsByClassName('dot')[0];
music.addEventListener('timeupdate',()=>{
      let music_curr = music.currentTime;
      let music_dur = music.duration;
      let min = Math.floor(music_dur/60);
      let sec = Math.floor(music_dur%60);
    if (sec<10) {
        sec = `0${sec}`
    }
      currentEnd.innerText = `${min}:${sec}`;
      let min1 = Math.floor(music_curr/60);
      let sec1 = Math.floor(music_curr%60);
    if (sec1<10) {
        sec1 = `0${sec1}`
    }
      currentStart.innerText = `${min1}:${sec1}`;
      let progressbar = parseInt((music.currentTime/music.duration)*100);
      seek.value = progressbar;
      let seekbar = seek.value;
      bar2.style.width = `${seekbar}%`;
      dot.style.left = `${seekbar}%`;
})
seek.addEventListener('change', ()=>{
    music.currentTime = seek.value * music.duration/100;
})
music.addEventListener('ended', ()=>{
    masterPlay.classList.add('bi-play-fill');
    masterPlay.classList.remove('bi-pause-fill');
    wave.classList.remove('active2');
})
let vol_icon = document.getElementById('vol_icon');
let vol = document.getElementById('vol');
let vol_dot = document.getElementById('vol_dot');
let vol_bar = document.getElementsByClassName('vol_bar')[0];
vol.addEventListener('change', ()=>{
    if (vol.value == 0) {
        vol_icon.classList.remove('bi-volume-down-fill');
        vol_icon.classList.add('bi-volume-mute-fill');
        vol_icon.classList.remove('bi-volume-up-fill');
    }
    if (vol.value > 0) {
        vol_icon.classList.add('bi-volume-down-fill');
        vol_icon.classList.remove('bi-volume-mute-fill');
        vol_icon.classList.remove('bi-volume-up-fill');
    }
    if (vol.value > 50) {
        vol_icon.classList.remove('bi-volume-down-fill');
        vol_icon.classList.remove('bi-volume-mute-fill');
        vol_icon.classList.add('bi-volume-up-fill');
    }
      let vol_a = vol.value;
      vol_bar.style.width = `${vol_a}%`;
      vol_dot.style.left = `${vol_a}%`;
      music.volume = vol_a/100;
})
let left_scroll = document.getElementById('left_scroll');
let right_scroll = document.getElementById('right_scroll');
let pop_song = document.getElementsByClassName('pop_song')[0];
left_scroll.addEventListener('click', ()=>{
    pop_song.scrollLeft -= 330;
})
right_scroll.addEventListener('click', ()=>{
    pop_song.scrollLeft += 330;
})
let left_scrolls = document.getElementById('left_scrolls');
let right_scrolls = document.getElementById('right_scrolls');
let item = document.getElementsByClassName('item')[0];
left_scrolls.addEventListener('click', ()=>{
    item.scrollLeft -= 330;
})
right_scrolls.addEventListener('click', ()=>{
    item.scrollLeft += 330;
})
let shuffle = document.getElementsByClassName('shuffle')[0];
shuffle.addEventListener('click', ()=>{
    let a = shuffle.innerHTML;
    switch(a) {
        case "next":
            shuffle.classList.add('bi-arrow-repeat');
            shuffle.classList.remove('bi-music-note-beamed');
            shuffle.classList.remove('bi-shuffle');
            shuffle.innerHTML = 'repeat';
        break;
        case "repeat":
            shuffle.classList.remove('bi-arrow-repeat');
            shuffle.classList.remove('bi-music-note-beamed');
            shuffle.classList.add('bi-shuffle');
            shuffle.innerHTML = 'random';
            break;
        case "random":
            shuffle.classList.remove('bi-arrow-repeat');
            shuffle.classList.add('bi-music-note-beamed');
            shuffle.classList.remove('bi-shuffle');
            shuffle.innerHTML = 'next';
        break;
    }
})