import React from 'react';
import ListWrapper from '../ListWrapper/ListWrapper';
import ResultItem from './ResultItem';

const Result = ({route, sampleRoutes, checkHandler}) => (
    <div className="container bg-gray-400 p-6">
        <div>
            <ListWrapper route={route}/>
        </div>
        <div>
            {sampleRoutes.map( (el, index) => ( <ResultItem {...el} 
                                                     key={index}
                                                     index={index}
                                                     checkHandler={checkHandler}/> ))}
        </div>
    </div>
);

export default Result;

