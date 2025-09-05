import React from "react";
import HeroAbout from "./about/Hero";
import VisiMisi from "./about/Visi";
import Tujuan from "./about/Tujuan";
import TeamSection from "./about/Team";

const About = () => {
  return (
    <div>
      <HeroAbout />
      <VisiMisi />
      <Tujuan />
      <TeamSection/>
    </div>
  );
};

export default About;
