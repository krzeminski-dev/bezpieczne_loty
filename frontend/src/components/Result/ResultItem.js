import React from 'react';
import CheckboxItem from './CheckboxItem';

const ResultItem = ({onMap, markers, checkHandler, index}) => (
   
   <>
    {index === 0 && <h2 className="text-2xl">Najkorzystniejsza trasa</h2>}
    {index === 1 && <h3 className="text-2xl">Trasy alternatywne</h3>}

    <div className="my-6">
        <p>Czy jest na mapie: {onMap ? 1 : 0}</p>
        <div className="flex">
        {markers.map(el => <p>{el.country}, {el.x}, {el.y}</p>)}
        </div>
            <CheckboxItem isChecked={onMap} 
                          index={index}
                          checkHandler={checkHandler}/>
    </div>
    </>

);

export default ResultItem;