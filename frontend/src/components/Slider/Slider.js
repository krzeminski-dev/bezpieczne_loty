import React, { Component } from 'react';
import './Slider.css';
import slide1 from '../../assets/images/slide1-sky.jpg';
import slide2 from '../../assets/images/slide2-writing.jpg';
import slide3 from '../../assets/images/slide3-virus.jpg';

// const Slider = () => (
//     <div className="slider container grid place-content-center bg-gray-400 p-6">
//         <p>Slider</p>
//     </div>
// );

// export default Slider;

const slides = [
    {
        image: slide1,
        text: 'Bardzo'
    },
    {
        image: slide2,
        text: 'Potężny'
    },
    {
        image: slide3,
        text: 'Slider'
    },
];

class Slider extends Component{

    state = {
        slides: [...slides],
        active: 0,
        max: slides.length-1
    };

    componentDidMount() { this.interval = setInterval(() => this.changeActiveSlide(), 7500); }
    
    componentWillUnmount() { clearInterval(this.interval); }

    changeActiveSlide(){ 
        if (this.state.active === this.state.max) { this.setState({ active: 0 }); } 
        else { this.setState({ active: this.state.active+1, }); }
    }
      
    render(){
        const {slides, active} = this.state;
        let styles = {
            backgroundImage: `url(${slides[active].image})`,
            //left: `${active*100}%`
        }
        return(
            <div className="outerWrap relative container rounded shadow-sm p-6 mt-6 bg-gray-500">
                <div className="slider container rounded relative" style={styles}>
                    <h1 className="rounded container slider__content text-white text-2xl h-full relative">
                        <span className="slider__text absolute">{slides[active].text}</span>
                    </h1>
                </div>
            </div>
        );
    }

};

export default Slider;