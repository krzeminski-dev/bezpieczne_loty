import React from 'react';
import ListWrapper from '../ListWrapper/ListWrapper';

const Result = (props) => (
    <div className="container bg-gray-400 p-6">
        <h3>Wynik</h3>
        <ListWrapper connections={props.connections}/>
{/* {props.connections[0].from[0]} */}
    </div>
);

export default Result;