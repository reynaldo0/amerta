import React from "react";
import Budaya from "./culture/awal/PulauBudaya";
import Hero from "./culture/awal/Hero";
import Questions from "./culture/awal/question";
import Tokoh from "./culture/awal/Tokoh";

const Culture = () => {
  return (
    <div>
      <Hero />
      <Budaya />
      <Tokoh />
      <Questions />
    </div>
  );
};

export default Culture;
