import React from 'react';
import './ListItem.css';
import PropTypes from 'prop-types';



const ListItem = ({
    x,
    y,
    country,
    number
}) => (
    <li className="listItem__wrapper bg-gray-500">  
        <div>
        <h2 className="listItem__name text-green-600">Test</h2>
            <p>{x}</p>
            <p>{y}</p>
            <p>{country}</p>
            <p>{number}</p>
            {/* <p>{to[0]}</p>
            <p>{to[1]}</p>   */}
        </div>
    </li>
);



export default ListItem;