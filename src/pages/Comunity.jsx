import React from "react";
import Events from "./comunity/Event";
import HeroCommunity from "./comunity/Hero";
import ForumSection from "./comunity/Forum";

const Comunity = () => {
  return (
    <>
      <HeroCommunity />
      <Events />
      <ForumSection />
    </>
  );
};

export default Comunity;
