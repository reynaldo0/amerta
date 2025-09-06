import CeritaRakyat from "./comunity/Cerita";
import Events from "./comunity/Event";
import ForumSection from "./comunity/Forum";
import HeroCommunity from "./comunity/Hero";

const Comunity = () => {
  return (
    <>
      <HeroCommunity />
      <Events />
      <CeritaRakyat />
      <ForumSection />
    </>
  );
};

export default Comunity;
