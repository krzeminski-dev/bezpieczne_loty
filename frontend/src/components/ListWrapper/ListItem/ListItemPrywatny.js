import React from 'react';
import './ListItem.css';
import PropTypes from 'prop-types';



const ListItem = ({
    from,
    to
}) => (
    <li className="listItem__wrapper bg-gray-500">  
        <div>
        <h2 className="listItem__name text-green-600">Test</h2>
            <p>{from[0]}</p>
            <p>{from[1]}</p>
            {/* <p>{to[0]}</p>
            <p>{to[1]}</p>   */}
        </div>
    </li>
);



export default ListItem;