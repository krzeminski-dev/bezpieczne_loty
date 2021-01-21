import React, { Component } from 'react';
import './Slider.css';
import slide1 from '../../assets/images/slide1-sky.jpg';
import slide2 from '../../assets/images/slide2-writing.jpg';
import slide3 from '../../assets/images/slide3-virus.jpg';

const slides = [
    {
        image: slide1,
        text: "",
    },
    {
        image: slide2,
        text: "",
    },
    {
        image: slide3,
        text: "",
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
        }
        return(
            <div className="outerWrap relative container  shadow-sm  bg-gray-500">
                <div className="slider container  relative" style={styles}>
                    <h1 className=" container slider__content text-white text-2xl h-full relative">
                        <span className="slider__text absolute">{slides[active].text}</span>
                    </h1>
                </div>
            </div>
        );
    }

};

export default Slider;