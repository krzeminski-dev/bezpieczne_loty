import React from 'react';
import './ListWrapper.css';
import ListItemPrywatny from './ListItem/ListItemPrywatny';

const ListWrapper = (props) => (
    <ul className="listWrapper__wrapper">
        {props.route.map(item => ( <ListItemPrywatny key={item.name} {...item}/> ))}
    </ul>
);

export default ListWrapper;