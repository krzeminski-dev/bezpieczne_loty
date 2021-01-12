import React from 'react';
import './Form2.css';

const Form2 = ({submitFn}) => (
   /*<form className="container bg-gray-500" onSubmit={submitFn}>*/
    <div className="form-wrap flex-1 p-6 bg-gray-200 rounded shadow-sm self-center">
        <p className="text-center bg-white -m-6 mb-6 p-6 font-bold rounded rounded-b-none border-b border-gray-400">Podaj informacje</p>
        <form onSubmit={submitFn}>
            
            {/* <label className="block">Miejsce wylotu</label>
            <input className="block" type="text" placeholder="Skąd"/>
            
            <label className="block">Cel trasy</label>
            <input className="block" type="text" placeholder="link"/> */}
           
                <label className="block mb-3">Miejsce wylotu</label>
                <input className="block box-border p-2 mb-4 rounded border-gray-400 border" type="text" placeholder="Skąd"/>
           
                <label className="block mb-3">Cel trasy</label>
                <input className="block box-border p-2 rounded border-gray-400 border" type="text" placeholder="Dokąd"/>
           
            {/* <label className="block mb-2">y1</label>
            <input className="block box-border p-2 mb-2" type="text" placeholder="y1"/>
            
            <label className="block mb-2">y2</label>
            <input className="block box-border p-2" type="text" placeholder="y2"/> */}
            
            <button className="self-end focus:border-b-2 mt-6 container duration-300 bg-blue-800 hover:bg-blue-700 hover:border-blue-800 text-white font-bold py-2 px-4 border-b-4  border-blue-900 rounded" type="submit">Szukaj trasy</button>
        </form>
    </div>
);

export default Form2;