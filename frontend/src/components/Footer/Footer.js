import React from 'react';
import './Footer.css';
import plane from '../../assets/images/plane2.svg'

const Footer = () => (
    <footer className="footer container flex justify-center bg-blue-800 text-white p-6 text-center mt-6 rounded shadow-sm">
     
            <img className="block footer__icon w-24 -mr-2" src={plane}></img>
            <p className="text-xl footer__content grid place-content-center">PG - projekt grupowy - 2021</p>

    </footer>
 );

export default Footer;