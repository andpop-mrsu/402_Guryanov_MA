import { start, id } from './Controller.js';
import { games } from './Model.js';

start();

export function print(){
    var ind = games.map(games => games.gameId);
    var coor = games.map(games => games.array_coord);
    var count = 0;

    for (var i = 0; i<= (ind.length-1); i++){
        if(ind[i] == id){
            listElem.innerHTML = `<table border=1 bgcolor="white" style="font-size: 18; margin-left: 480px"><tr><td id="list" >${coor[i].join('<br>')}</id=>`;
            count = 1;
        }
    }
    if(count == 0){
        listElem.innerHTML = '<h2 id="label" align="center">Такой сыгранной партии пока нет</h2>'
    }
} 