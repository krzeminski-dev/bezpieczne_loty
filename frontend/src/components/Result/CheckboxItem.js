import React from 'react';

const CheckboxItem = ({isChecked, checkHandler, index}) => (
    <>
    <input type="checkbox" 
           onChange={() => checkHandler(index)}
           checked={isChecked}
           /> 
    <label>Pokaż na mapie</label>
    </>
);

export default CheckboxItem;