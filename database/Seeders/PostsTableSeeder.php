<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'owner_id' => 1,
                'category_id' => 13,
                'temporal_id' => 1,
                'type' => 1,
                'slug' => 'homeopathy-awareness-week',
                'meta_title' => 'Homeopathy Awareness Week',
                'meta_description' => 'Homeopathy awareness week 2015: encouraging the public understanding of homeopathy.',
                'meta_keywords' => 'homeopathy, alternative medicine, quackery',
                'title' => 'Homeopathy Awareness Week',
                'subtitle' => 'The campaign to raise awareness of homeopathy',
                'summary' => '<p>June <img class="image_right" title="" src="../../../graphics/scam-smart_thumb.gif" alt="Don\'t be scammed image" width="125" height="153" />14<sup>th</sup> to 21<sup>st</sup> 2013 sees the annual event that is known as \'Homeopathy Awareness Week\'.&nbsp; Normally awareness promotion campaigns are done in order to benefit the public in some way. e.g. promoting awareness of symptoms of breast or testicular cancer. However, this awareness campaign is run by homeopaths for the benefit of, well, homeopaths. This \'awareness week\' is really nothing more than an advertising campaign.</p>
<p>However, I do think it is worth the general public becoming more aware of homeopathy and the reality behind the claims homeopaths make. After all, homeopathy is being sold as <em>medicine</em>.</p>',
                'body' => '<p><span class="image-right"><img class="image_right" title="" src="../../../graphics/scam-smart.gif" alt="Scam Smart picture" width="244" height="298" /></span>April 10<sup>th</sup> to 16<sup>th</sup> each year sees the annual event that is known as \'Homeopathy Awareness Week\'.&nbsp; Normally awareness promotion campaigns are done in order to benefit the public in some way. e.g. promoting awareness of symptoms of breast or testicular cancer. However, this awareness campaign is run by homeopaths for the benefit of, well, homeopaths. This \'awareness week\' is really nothing more than an advertising campaign.</p>
<p>However, it <em>is</em> worth the general public becoming more aware of homeopathy and the reality behind the claims homeopaths make. After all, homeopathy is being sold as <em>medicine</em>.</p>
<h3 class="subheading">What is homeopathy?</h3>
<p>Homeopathy is a system of alternative medicine that was invented over two centuries ago. A German physician called Samuel Hahnemann believed that he had found a new way to treat illness. Instead of treating an illness by trying to reverse its symptoms, such as trying to cool down someone with a fever, Hahnemann treated patients with remedies that caused the same symptoms as the disease; so something that causes a high temperature, shaking etc., would be used to treat a fever.</p>
<p>Many remedies Hahnemann used were poisonous and could kill patients; so he started diluting his remedies to reduce their toxicity. This is where he believed that he\'d made another new discovery: succussion. Between each dilution of his remedy, which would of course make it weaker, he banged it ten times against a leather-bound bible. He believed that this banging of the remedy (succussing it) transferred more of the healing properties of the remedy to the water. In other words, the more dilute it became, the stronger the remedy became!</p>
<p>What Hahnemann didn\'t know at that time, this was in the days of pre-scientific medicine, was that you can only dilute a substance a certain number of times before there is none of the starting material left. Hahnemann went way, way beyond the dilution limit with his remedies and, although he didn\'t know it, all his remedies ended up consisting of was water. After all the effort of testing and choosing remedies and then going through the dilution process, all he was treating his patients with was water!</p>
<p>We know better than this today. Neither choosing remedies based on matching symptoms nor diluting the remedy out of existence is a valid way of producing an effective remedy. Even if you did randomly pick something that could work, by the time you\'ve diluted it to the point where only water remains you\'re not going to cure anything with it - except dehydration perhaps.</p>
<h3 class="subheading">How does modern homeopathy differ from the original?</h3>
<p>It doesn\'t! Despite all of the scientific advances in understanding over the last two centuries, modern homeopathy is based on exactly the principles laid down by Hahnemann. Hay fever causes a runny nose and irritation to the eyes; onions cause a runny nose and irritation to the eyes; therefore, the \'remedy\' for hay fever is onion. Of course, the extract of onion is diluted until there\'s no more onion at all left in the remedy...</p>
<p>Most modern homeopathic remedies, no matter what they\'re meant to be for, contain no ingredients. The resulting water from the remedy is sprayed onto sugar pills and allowed to dry. The process is claimed to go something like: the healing properties of the remedy that was chosen for the wrong reason, were thumped into the water between dilutions. The now remedy-free water is sprayed on to sugar pills and allowed to evaporate which supposedly transfers the healing properties of the non-existent remedy onto the sugar pills...</p>
<p>... and... (yes, it gets even sillier)... if you place one of these homeopathic pills in a jar with stock sugar pills and leave it a while, the healing powers of the homeopathic sugar pill somehow transfer to all of the other sugar pills in the jar as well (a process they call \'grafting\').</p>
<h3 class="subheading">Homeopathy: did you know?</h3>
<table style="border: 1px solid #666;">
<tbody>
<tr>
<td class="b" style="width: 40px;"><img src="../../../graphics/question_mark.png" alt="Question mark" width="40" height="40" /></td>
<td class="r b" style="vertical-align: middle;"><strong>Homeopathy is not herbal medicine</strong></td>
<td class="b" style="vertical-align: middle;"><img title="" src="../../../graphics/question_mark.png" alt="Question mark" width="40" height="40" /></td>
<td class="b" style="vertical-align: middle;"><strong>Homeopathic remedies contain no ingredients</strong></td>
</tr>
<tr style="vertical-align: top;">
<td class="r" style="width: 50%;" colspan="2">
<p class="pad">Many people think that homeopathy is just another name for herbal medicine; however, it is a completely different concept altogether.</p>
</td>
<td style="width: 50%;" colspan="2">
<p class="pad">As incredible as it may sound, it is actually true that almost all homeopathic remedies contain no ingredients at all. This is because the dilution process they use removes all traces of the starting material.</p>
</td>
</tr>
<tr>
<td class="t" style="width: 40px;"><img src="../../../graphics/question_mark.png" alt="Question mark" width="40" height="40" /></td>
<td class="t r" style="vertical-align: middle;"><strong>Homeopathy is alternative medicine</strong></td>
<td class="t" style="width: 40px;"><img title="" src="../../../graphics/question_mark.png" alt="Question mark" width="40" height="40" /></td>
<td class="t" style="vertical-align: middle;"><strong>Homeopathic remedies are based on superstition</strong></td>
</tr>
<tr style="vertical-align: top;">
<td class="t r" style="width: 50%;" colspan="2">
<p class="pad">Homeopaths like to inform people that there are homeopathic hospitals within the NHS. What they don\'t tell you is that there are only 3 of them left, that they are mainly small units within real hospitals and that they are in decline due to modern evidence-based practices in the NHS - the fact is, they only exist as a historical anachronism.</p>
</td>
<td class="t" style="width: 50%;" colspan="2">
<p class="pad">The \'like cures like\' principle of homeopathy is actually a superstitious concept. Like affecting like is a principle in Voodoo, for example. This is why homeopathy is often referred to as \'voodoo medicine\'. e.g. The cure for insomnia, according to homeopathic principles, is caffeine! Although the remedy is chosen via this superstitious principle, there will be no caffeine in a \'caffeine remedy\'.</p>
</td>
</tr>
<tr>
<td class="t" style="width: 40px;"><img src="../../../graphics/question_mark.png" alt="Question mark" width="40" height="40" /></td>
<td class="t r" style="vertical-align: middle;"><strong>The evidence base for homeopathy is very poor</strong></td>
<td class="t" style="vertical-align: middle;"><img src="../../../graphics/question_mark.png" alt="Question mark" width="40" height="40" /></td>
<td class="t" style="vertical-align: middle;"><strong>Homeopaths treat the symptoms, not the underlying disease</strong></td>
</tr>
<tr style="vertical-align: top;">
<td class="t r" style="width: 50%;" colspan="2">
<p class="pad">Homeopaths will often state that there is a lot of evidence in support of homeopathy. This is actually true; however, what they don\'t tell you is that the quality of evidence is extremely poor. It is always possible that something that seems incredibly implausible might work for some reason we don\'t understand. If this were so then positive results would occur in high quality clinical trials despite the lack of a sound theory; but the evidence shows that when high-quality trials are done on homeopathy, the results show it doesn\'t work. Having \'a lot\' of poor quality evidence doesn\'t really mean anything.</p>
</td>
<td class="t" style="width: 50%;" colspan="2">
<p class="pad">Alternative medicine practitioners usually put this the other way round including it with their claim to be \'holistic\'. However, homeopaths only ever consider symptoms. They take a symptom profile from their patient, look in a book of remedies and choose one based on the symptoms that the remedy causes - the matching of symptoms being the only way remedies are chosen. The glaring omission in this process is one thing that should be of major concern: at no time does a homeopath ever diagnose the illness/disease - that\'s not very reassuring for those who might have a serious condition.</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<h3 class="subheading">Has homeopathy been properly tested?</h3>
<p>Yes it has. Good quality clinical trials show that it works at the same level as dummy placebo pills (i.e. it doesn\'t work); poorer quality trials usually show it works to some degree - but this is because of the poor trial quality (See the links below for more detail).</p>
<p>The James Randi Educational Foundation offers $1,000,000 to anyone who can show that homeopathy works (under properly controlled conditions, of course). A test could be as simple as a homeopath being able to tell the difference, by any means, between stock sugar pills and homeopathically treated sugar pills. Randi actually put his $1 million on the line in an investigation carried out by the BBC\'s <em>Horizon</em> programme. The test failed and Randi kept the money (<a href="http://www.bbc.co.uk/science/horizon/2002/homeopathy.shtml" target="_blank" rel="noopener">link</a>)</p>
<p>Another, albeit non-scientific, demonstration of homeopathy\'s ineffectiveness was performed in 2010 by the 10:23 campaign. Groups of people in several cities around the UK bought packs of homeopathic sleeping pills and overdosed on them in public. Unsurprisingly, no one fell asleep nor did anyone suffer any side effects from the overdose. That\'s down to the inherent safety of medicine that contains no ingredients!</p>
<h3 class="subheading">Conclusion</h3>
<p>Homeopathy awareness week is simply homeopaths trying to advertise their industry to drum up more business. It\'s not something that\'s meant to benefit the consumer.</p>
<p>It is often argued that homeopathy is a dangerous menace as it\'s nothing but pre-scientific quackery; others respond that it\'s essentially harmless even if it doesn\'t work so it\'s not worth getting too concerned about. However, from a consumer\'s point of view, it is simply another rip-off. Homeopathy is nothing more than ingredient-free \'remedies\' being sold as if they\'re medicine - for a very good mark up.</p>
<p>There is nothing illegal about homeopathy. They are allowed, by the MHRA (of all organizations!) to market this stuff with claims that it can be \'used to treat\' self-limiting ailments. Homeopaths have the right to advertise and promote their products (within limits) so consumers need to be more savvy about accepting their claims.</p>
<hr />
<p><strong>Further reading:</strong></p>
<p class="no_underline"><!--#125#-->An overview of homeopathy<!--/#--><br /><!--#126#-->Homeopathic dilutions<!--/#--><span style="font-size: small;"> - how we know there are no ingredients in homeopathic remedies</span><br /><!--#127#-->Homeopathic potentisation<!--/#--><span style="font-size: small;"> - the superstition behind homeopathy</span><br /><a href="http://www.ebm-first.com/homeopathy.html" target="_blank" rel="noopener">A huge information resource</a><br /><a href="http://www.1023.org.uk/" target="_blank" rel="noopener">10:23 campaign</a><br /><a href="http://www.sciencebasedmedicine.org/index.php/category/homeopathy/" target="_blank" rel="noopener">Science-based medicine on homeopathy </a></p>
<hr />
<p style="text-align: center;"><strong>Mitchell and Webb\'s: homeopathic A&amp;E</strong></p>
<p style="text-align: center;"><iframe src="http://www.youtube.com/embed/HMGIbOGu8q0" width="425" height="350"></iframe></p>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => 'boiron-homeopathy-tube.jpg',
                'publication_date' => '2020-05-16 16:34:00',
                'created_at' => '2020-05-16 16:34:33',
                'updated_at' => '2021-05-19 15:40:35',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'owner_id' => 1,
                'category_id' => 8,
                'temporal_id' => NULL,
                'type' => 2,
                'slug' => 'do-extraordinary-claims-require-extraordinary-evidence',
                'meta_title' => 'Do extraordinary claims require extraordinary evidence?',
                'meta_description' => 'An examination of whether the claim that extraordinary claims require extraordinary evidence is true.',
                'meta_keywords' => 'extraordinary claims require extraordinary evidence, ecree',
                'title' => 'Do extraordinary claims require extraordinary evidence?',
                'subtitle' => NULL,
                'summary' => NULL,
                'body' => '<p><img class="image_right" src="/graphics/ecree.png" alt="Sagan: extraordinary claims require extraordinary evidence" width="350" height="146" /></p>
<p>The claim that &ldquo;extraordinary claims require extraordinary evidence&rdquo; (ECREE) is often used in argumentation, usually with regard to claims of a religious, paranormal or pseudo-scientific nature. It\'s often used axiomatically or as a dictum in debates; its popularity being attributed to Carl Sagan. The purpose of using the statement is to show that the claim in question should not or cannot be accepted as the evidence required to support it is beyond what would normally be acceptable for a more mundane claim.</p>
<p>How robust is this saying as a factual claim though? Does it stand up to scrutiny?</p>
<h3 class="subheading">Lack of definitions</h3>
<p>There is no definition given, nor is there any general consensus, for what constitutes an extraordinary claim or extraordinary evidence, so a good place to begin is to look at what they may mean.</p>
<p>The first thing to note is that the word &ldquo;extraordinary&rdquo; appears twice in the statement, so it is important to examine whether the word is used consistently. One way of doing this is to choose a likely meaning for it and substitute the new word or phrase in its place to see whether the statement still holds. With regard to claims, &ldquo;extraordinary&rdquo; is usually taken to mean something along the lines of &ldquo;paranormal&rdquo;, &ldquo;highly unlikely to be true&rdquo;, &ldquo;violates the laws of nature&rdquo;, or &ldquo;goes against our current understanding&rdquo;. Substituting these replacements into the statement for &ldquo;extraordinary&rdquo; gives us:</p>
<ol>
<li>Paranormal claims require paranormal evidence.</li>
<li>Claims that are highly unlikely to be true require evidence that is highly unlikely to be true.</li>
<li>Claims that violate the laws of nature require evidence that violates the laws of nature.</li>
<li>Claims that go against our current understanding require evidence that goes against our current understanding.</li>
</ol>
<p>These statements clearly do not make sense. This means that the word &ldquo;extraordinary&rdquo;, as used in the statement &ldquo;extraordinary claims require extraordinary evidence&rdquo;, is used <em>equivocally:</em> the adjective &ldquo;extraordinary&rdquo; does not mean the same thing when used to describe &ldquo;claim&rdquo; as it does when used to describe "evidence". Rarely, if ever, do proponents of ECREE state what they mean by &ldquo;extraordinary evidence&rdquo; &ndash; it\'s usually implied to mean &ldquo;more&rdquo; and/or &ldquo;better quality&rdquo; but its extraordinary <em>nature</em> isn\'t addressed. If evidence for any claim can be gathered for scrutiny, such as from observation or scientific experiments, then this is ordinary, standard evidence. The nature of the claim is of no relevance.</p>
<p>Both &ldquo;extraordinary claims&rdquo; and &ldquo;extraordinary evidence&rdquo; lack <a href="http://en.wikipedia.org/wiki/Precising_definition" target="_blank" rel="noopener"><em>precising definitions</em></a>, so are ambiguous and vague. This is enough to invalidate the statement as it stands as a factual one as the statement can be subjectively interpreted: what one person considers to be an extraordinary claim may be interpreted as a perfectly normal or acceptable claim by someone else.</p>
<h3 class="subheading">Is there an underlying principle nonetheless?</h3>
<p>This problem of equivocation may have arisen simply because the phrase was designed to be catchy and memorable; but is the &ldquo;pop science&rdquo; nature of the phrase (which was probably worded to appeal to a non-scientific audience) based on an underlying scientific principle regarding claims and evidence?</p>
<p>The phrase suggests that there is some directly proportional link between the nature of a claim and the nature, amount and/or quality of the evidence required to support it. But is this true?</p>
<p>Proponents of the phrase will often give examples by using contrasting claims such as &ldquo;I have a pet dog&rdquo; versus &ldquo;I have a pet dragon&rdquo; or &ldquo;I have captured a new species of lizard&rdquo; versus &ldquo;I have captured an alien&rdquo; and explaining that the first instance is not extraordinary therefore very easy to accept whereas the second claim <em>is</em> extraordinary and would require more evidence than the first. The problem with this type of reasoning is that it confuses <em>accepting</em> a claim with <em>establishing</em> a claim.</p>
<p>In order to establish that someone owned a pet dragon (a fire-breathing one, not a Komodo!) all that would be required is that they produce the animal - which is no different from them producing a dog. Likewise, producing an alien\'s body for anatomical examination is no different from producing a lizard\'s body. The finding may be &ldquo;extraordinary&rdquo; in some cases, but the evidence required to establish the claim is still quite &ldquo;ordinary&rdquo;.</p>
<p>The correct way to test something is not to generate examples of where it is true (i.e. attempting to confirm it) but to generate examples of where it is false (attempting to falsify it). In order to test whether ECREE is true, all that\'s required is to see whether there\'s an example where it is or would be false. An example would be: if someone claimed they could levitate an anvil using their psychokinetic power, something that would qualify as an extraordinary claim for most people, it would be very simple to design a properly controlled test capable of establishing the claim should it be true. There would be nothing extraordinary about the testing or the evidence, even if a positive result would be truly astonishing.</p>
<p style="margin-bottom: 0in;">Sometimes arguments using Bayesian statistics are used to defend ECREE. The idea is that a claim with a very low prior probability (i.e. extraordinary) will require evidence that is proportionally substantial enough to overcome the claim\'s low prior probability. Such evidence is then defined as \'extraordinary\'. However, this is simply circular reasoning: it\'s nothing more than restating ECREE in slightly different terms.</p>
<p>All claims are different and will therefore require different levels, amount and types of evidence in order to establish them. Some simple claims will require minimal evidence and some simple claims will require substantial evidence. Likewise, some unlikely or complex claims will require simple evidence and some will require substantial evidence. The point here is that there is no fixed relationship between a claim and the evidence required to establish it. Each individual claim needs to be assessed and the evidence required to establish it worked out as appropriate.</p>
<p>Some claims that may be deemed &ldquo;extraordinary&rdquo; certainly will require a level of evidence that may be deemed &ldquo;extraordinary&rdquo;; but it\'s not a universal principle.</p>
<p>In short: the nature, amount or type of evidence required to support or establish a claim is not dependent upon the claim\'s nature or prior probability.</p>
<h3 class="subheading">ECREE used in debates</h3>
<p>People who oppose or reject claims that they deem to be &ldquo;extraordinary&rdquo; will often use ECREE in debates as if it is true or a confirmed and accepted scientific principle. And because they assume this, it is often used to dismiss claims out of hand or in a &ldquo;moving the goalposts&rdquo; manner where any evidence that is presented is rejected because it isn\'t extraordinary enough &ndash; although what would be extraordinary enough isn\'t normally stated.</p>
<p>If, however, ECREE is used as a general, guiding rule (in a similar way to Occam\'s Razor) as a precaution against being too quick to accept weak evidence as confirming claims that are highly unlikely, then its use is reasonable. For example, if someone reports a psychic effect that is very weak (has a very small effect size) and is statistically significant (e.g., p&lt;0.05), it would be wise to reserve judgement, rather than jumping to a conclusion, as its likelihood of being true to begin with would be very small and the result could be a false positive. (<strong>NOTE</strong>: this is a confirmatory example, not a case for ECREE\'s universal application.)</p>
<h3 class="subheading">Conclusion</h3>
<p>The claim &ldquo;extraordinary claims require extraordinary evidence&rdquo; lacks definition which makes its meaning ambiguous. Therefore, it is not legitimate as a scientific claim or rule. Even if someone defines its terms before using it, it\'s still problematic as the underlying assumption - that there is a universal, directly proportional relationship between the nature of a claim and the nature of the evidence required to support/establish it - is not true.</p>
<p>Although there are instances where its usage as a precautionary approach to accepting unlikely claims may seem appropriate, caution should always be exercised when ECREE is used or encountered as it is not a universal principle and so can be misapplied or even abused: to dismiss evidence, avoid debate, avoid assessing pertinent claims, etc.</p>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => NULL,
                'publication_date' => '2020-05-16 16:34:33',
                'created_at' => '2020-05-16 16:34:33',
                'updated_at' => '2020-05-17 11:04:13',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'owner_id' => 2,
                'category_id' => 11,
                'temporal_id' => NULL,
                'type' => 2,
                'slug' => 'ad-hominem',
                'meta_title' => 'The Ad Hominem fallacy',
                'meta_description' => 'The Ad Hominem fallacy: attacking the person instead of their argument.',
                'meta_keywords' => 'argumentum ad hominem',
                'title' => 'The Ad Hominem fallacy',
                'subtitle' => 'Attacking the person instead of their argument',
                'summary' => NULL,
                'body' => '<p><strong>Basic structure:</strong></p>
<ol>
<li>Person X presents an argument;</li>
<li>There is something questionable about person X\'s character or circumstances; therefore</li>
<li>Person X\'s argument should be rejected.</li>
</ol>
<p>As with all informal fallacies, when it\'s used in a strong or deductive manner, ad Hominem is always fallacious; but when it\'s used informally or inductively, it may be pertinent.</p>
<p>The ad Hominem is classed as a fallacy of relevance; consequently, when it is encountered its relevance needs to be assessed as there may be instances where a person\'s character or circumstance has a bearing on their claim.</p>
<h3 class="subheading">Subtypes of ad Hominem</h3>
<ul>
<li>
<p><strong>Personal attack</strong><br /><br />This is where the person\'s negative traits or characteristics (real or otherwise) are introduced in order to weaken or dismiss their argument. People may be called stupid, arrogant, racist, fascist or likened to others who are perceived in this way. The idea is to show that the person making the claim cannot be trusted, has bad motives, is incapable of providing a properly reasoned argument, etc.<br /><br />The abusive ad Hominem is often used when people can\'t explain their position or defend it from counter-arguments. It\'s often simply a case of: <em>Don&rsquo;t like the message? Then shoot the messenger.</em><br /><br />NOTE: An ad Hominem and an insult are not the same thing. An ad Hominem is used as a reason to reject the person\'s claim. An insult is simply aimed at the person.</p>
</li>
<li>
<p><strong>Poisoning the well</strong><br /><br />This is a pre-emptive personal attack. The person\'s character or circumstances are attacked before the person has had an opportunity to present their argument. The purpose of this is to bias people against the claimant in advance so they will not take the claimant seriously when they do encounter the claimant\'s argument.</p>
</li>
<li>
<p><strong>Circumstantial</strong><br /><br />As its name suggests, this version of ad Hominem appeals to a person\'s circumstances as being the motivation for why they\'re making the argument they are. <br /><br />It is not necessarily abusive in nature, it\'s about raising doubts about the claimant\'s motivation for making their argument. e.g. a person\'s anti-abortion views could be rejected because they are a Catholic &ndash; the implication being that they\'re repeating religious dogma and not providing a reasoned argument.</p>
</li>
<li>
<p><strong>Tu quoque, hypocrisy, inconsistency</strong><br /><br />This version of the ad Hominem focuses on inconsistencies in the claimant\'s position. Someone may make a claim that is inconsistent with how they act themselves or which contradicts something they\'ve said before.<br /><br />This version is often used in politics. e.g. if a minister puts forward a case for keeping a nuclear deterrent and it turns out they used to be a member of the Campaign for Nuclear Disarmament, their opponents will use the inconsistency to suggest that there\'s something going on, other than a genuine change of mind, to weaken or reject the claim.<br /><br />&ldquo;You should give up smoking because it\'s bad for you&rdquo; could be answered with &ldquo;well you\'re a fine one to talk&rdquo; if the person giving the advice is a smoker themselves. However, the advice is good whether the person giving the advice is a smoker or not &ndash; their indulgence in the habit doesn\'t weaken or negate their claim.</p>
</li>
</ul>
<h3 class="subheading">Evaluating ad Hominems</h3>
<p>Any claim or information about a person that\'s introduced which is intended to affect their argument needs to be assessed. Although ad Hominems are always deductively fallacious, the information may be relevant. Look at this example:</p>
<p style="padding-left: 30px;">&ldquo;Teachers should be given a higher than inflation pay rise this year to reward the extra work they now have to do and to help retain good teachers.&rdquo;</p>
<p style="padding-left: 30px;">&ldquo;You would say that. You\'re a teacher!&rdquo;</p>
<p>This is a circumstantial ad Hominem. The fact that the person arguing for a teachers\' pay rise happens to be a teacher doesn\'t invalidate their argument; however, there is also a possibility that this person\'s arguments are influenced by self-interest, so the information about the arguer\'s profession is relevant as it could affect the strength of their argument.</p>
<p>The main issues when assessing ad Hominem arguments are:</p>
<ol>
<li>Is the information introduced relevant; and if so</li>
<li>To what extent?</li>
</ol>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => NULL,
                'publication_date' => '2020-05-16 16:34:00',
                'created_at' => '2017-03-24 17:13:27',
                'updated_at' => '2021-05-17 11:26:15',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'owner_id' => 1,
                'category_id' => 8,
                'temporal_id' => NULL,
                'type' => 2,
                'slug' => 'appeal-to-open-mindedness',
                'meta_title' => 'The appeal to open mindedness',
                'meta_description' => 'A critical look at appeals to open mindedness.',
                'meta_keywords' => 'open mind, psychology, confirmation bias, fallacies, errors of reasoning',
                'title' => 'The appeal to open mindedness',
                'subtitle' => 'An open mind: a mind open to new ideas, lacking in prejudice, not dogmatic',
                'summary' => NULL,
                'body' => '<div class="argument_box">
<div class="argument_box-row">
<div class="argument_box-person">Tom:</div>
<div class="argument_box-speech">I believe X</div>
</div>
<div class="argument_box-row">
<div class="argument_box-person">Jerry:</div>
<div class="argument_box-speech">Scientific studies don\'t support that X is true.</div>
</div>
<div class="argument_box-row">
<div class="argument_box-person">Tom:</div>
<div class="argument_box-speech">I, like millions of others, have tried X and found that it\'s true.</div>
</div>
<div class="argument_box-row">
<div class="argument_box-person">Jerry:</div>
<div class="argument_box-speech">I\'d need something more than personal testimony to accept such an unlikely claim.</div>
</div>
<div class="argument_box-row">
<div class="argument_box-person">Tom:</div>
<div class="argument_box-speech">Well, perhaps if you were a bit more open minded....</div>
</div>
</div>
<p>It is very common for people who are putting forward a claim to say something like, "<em>you must consider this with an open mind</em>" or, if their claim is rejected, they will say something like, "<em>well of course you don\'t believe it, you\'re closed-minded</em>". It\'s often used by those who believe in unlikely, or even disproved, ideas that can\'t be supported by reason or evidence.</p>
<p>There are many ways that this \'appeal to open mindedness\' manifests itself, so let\'s have a look at why it is not usually a good claim.</p>
<h3 class="subheading">What is an open-minded person?</h3>
<p>An open-minded person is someone who is willing to consider ideas, opinions and arguments purely <em>on their merit</em>. If a claim can be shown to be correct then an open-minded person will alter, or add to, their world-view with this new-found knowledge.</p>
<p>Although being open-minded means a willingness to consider that a claim may be true, it also means considering the possibility that it may be false. A truly open-minded person\'s mind is open to both possibilities. An open-minded approach to assessing claims does not preclude rejecting claims if they\'re found wanting.</p>
<h3 class="subheading">Misuse of the term "open-minded"</h3>
<p>Exchanges like Tom &amp; Jerry\'s above are quite common in debates and can be very frustrating to those on the receiving end. This is because we generally regard open-mindedness to be a virtue, so any suggestion we\'re not open-minded is taken as a personal slur or attack &ndash; which it is. An attempt to win a debate by attacking the person rather than their argument is, of course, simply a fallacious <!--#107#-->Ad Hominem<!--/#-->.</p>
<p>A deeper problem with this issue, however, is that the term &ldquo;open minded&rdquo; is wrongly characterised as simply meaning &ldquo;accepting claims&rdquo;, or worse, &ldquo;accepting claims without good reason or evidence&rdquo;. This is not open-mindedness. The actual word for a person who is too willing to believe things is: <em>credulous</em>.</p>
<p>The appeal to open-mindedness, when used in this context, is really an appeal to relinquish one\'s rational integrity. It\'s an appeal to accept something without good reason under the guise that it is virtuous to do so. Of course, once it\'s realised that the virtue of being open-minded has been substituted with the folly of being credulous, the absurdity of doing so is clear.</p>
<h3 class="subheading">Summary</h3>
<p>Open-mindedness is considered a virtue, and true open-mindedness <em>is</em>.</p>
<p>The appeal to open-mindedness is frequently used by people who wish to sound virtuous, and simultaneously make their opponent sound intolerant, while defending or promoting their ideas and beliefs. However, this argumentative tactic relies on using the term &ldquo;open-minded&rdquo; to describe uncritical belief acquisition or defend cherished beliefs when &ldquo;credulous&rdquo; would be a more appropriate epithet.</p>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => NULL,
                'publication_date' => '2004-10-11 00:00:00',
                'created_at' => '2020-05-17 11:21:40',
                'updated_at' => '2021-05-17 12:05:59',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'owner_id' => 1,
                'category_id' => 11,
                'temporal_id' => NULL,
                'type' => 2,
                'slug' => 'appeal-to-authority',
                'meta_title' => 'Appeal to Authority',
                'meta_description' => 'A descriptive overview of the Appeal to Authority fallacy.',
                'meta_keywords' => 'appeal to authority fallacy Irrelevant Authority, Questionable Authority, Inappropriate Authority, Argumentum ad Verecundiam, logical fallacy.',
                'title' => 'Appeal to Authority',
                'subtitle' => 'Also known as: Appeal to: Irrelevant Authority, Questionable Authority, Inappropriate Authority, Argumentum ad Verecundiam.',
                'summary' => NULL,
                'body' => '<p>An Appeal to Authority is where someone puts forward an argument and invokes some entity\'s conclusion, relying on its authoritative position or status, to support it rather than providing their own reasoning or evidence. Such an entity could be a group, person, organisation, scripture, etc.</p>
<h3 class="subheading"><strong>The basic structure is:</strong></h3>
<p><strong>Strong sense</strong>:</p>
<ol>
<li>An authority has stated that X is true; therefore</li>
<li>X is true.</li>
</ol>
<p>or <strong>Weak sense</strong>:</p>
<ol>
<li>An authority has stated that X is probably true; therefore</li>
<li>X is probably true.</li>
</ol>
<p>When used in a strong sense, an Appeal to Authority is always fallacious. This is because there\'s no guarantee that an authority will be correct. In short, even experts can be wrong.</p>
<p>The Appeal to Authority is normally used in a weaker sense in support of a claim; and when used this way, its quality can vary from being perfectly reasonable to completely untenable.</p>
<p>In order to evaluate the strength of an Appeal to Authority, several aspects need to be addressed.</p>
<ol>
<li>
<p><strong>Who or what is the authoritative source of information?</strong><br /><br />Is the person, organization, or source being referenced really an authoritative source? It is important to distinguish between an authority and a <em>perceived</em> authority as the degree to which an authoritative source can be used to support a claim depends crucially on their actual authoritative status.<br /><br />In academic fields, experts will normally be relevantly qualified, have published papers, be recognized by their peers, etc., which means their status can be gauged reasonably easily and accurately. In other areas, such as in the humanities, sport or the &ldquo;soft sciences&rdquo;, what constitutes an expert can be harder to establish.<br /><br />The authority should also be identified, otherwise the fallacy of &ldquo;Appeal to Unidentified Authority&rdquo; occurs. Phrases such as: &ldquo;scientists agree that...&rdquo;, &ldquo;I read a book which said...&rdquo;, &ldquo;I heard an expert say...&rdquo; and similar are not legitimate Appeals to Authority.</p>
</li>
<li>
<p><strong>Is the source qualified in the relevant area?</strong><br /><br />It is not sufficient for a source simply to be an authority when used to support a claim; the authority also needs to be an expert in the relevant area. An expert who is commenting on something outside their area of expertise will provide a reduced, perhaps insufficient, level of support for the claim.<br /><br />Expertise in one area does not mean that someone is an expert in unrelated areas. For example, a world renowned physicist should not automatically be afforded the status of expert when talking about child rearing practices &ndash; even if she\'s a mother herself.<br /><br />There are also topics where it\'s hard to decide what it means to be an expert. Can someone be an expert in astrology, for example? It may be possible to be an expert <em>about</em> astrology but is it possible to discern whether one astrologer\'s ideas on astrology are any better than any other astrologer&rsquo;s?</p>
</li>
<li>
<p><strong>Is the source impartial in respect of the claim?<br /><br /></strong>Although a relevant authoritative source may have been cited to support a claim, it is important to ascertain whether the source is biased in some way which influenced its conclusion rather than it being based on reason or evidence alone.<br /><br />Everyone has their own biases: prior beliefs, world-view, cultural or religious background, etc., which influence them, so no person is ever free from bias. Even in science, especially the &ldquo;soft sciences&rdquo;, evidence is evaluated and this means that personal biases can creep in. It\'s the degree to which biases can influence conclusions that needs to be assessed &ndash; not just the presence of biases per se.<br /><br />Examples: an obstetrician may express anti-abortion views. If they are also a strict, practising Catholic, their religious beliefs may have more to do with their conclusion than the science or other aspects of the issue &ndash; thus weakening their status as an impartial authority. Or, a dentist may recommend a certain brand of toothpaste, but if they\'re being paid to advertise it by the manufacturer, their impartiality has to be doubted.</p>
</li>
<li>
<p><strong>Do other similarly relevant experts hold the same conclusion?</strong><br /><br />An individual authority\'s conclusion on an issue will not be sufficient to support a claim on its own. For an expert\'s conclusion to be strongly supportive of a claim, their conclusion must also be held by the vast majority of their peers. This is because some relevantly qualified experts hold views that are in complete contrast to the consensus view in their field &ndash; which means they are unlikely to be right.<br /><br />This is usually clear-cut with scientific issues; however, there are other areas where there\'s much disagreement even between the experts in the field. Political debates, e.g. how to tackle a budget deficit, often result in experts proposing completely different, often contradictory, solutions to the same problem. In this scenario, any appeal to an authority in support of a conclusion is going to be very weak &ndash; as counter-Appeals to Authority will be of equal strength.<br /><br />This issue of consensus is not about whether any particular expert is right or wrong, but how their position within their field affects their strength as an authority. The easier their conclusion is to challenge, the weaker their status as an authority is in support of an argument.</p>
</li>
</ol>
<h3 class="subheading">Is an Appeal to Authority always fallacious?</h3>
<p>Formally, or deductively, yes.</p>
<p>However, an Appeal to Authority is normally used inductively, or informally, and so the issue surrounding its usage is the level of support it gives to a claim &ndash; i.e. does it strongly or weakly support the claim?</p>
<p>If the criteria stated above are matched then the authority\'s position will strongly support the claim; but if the criteria, one or more, are not matched then the level of support for a claim is weaker or even non-existent.</p>
<p>Some issues are very complex and beyond the expertise of the individual trying to assess them. In such instances, it is reasonable to appeal to an authority\'s position on the matter as long as it\'s a reliable, recognized, impartial and accepted authority.</p>
<p>A good example is the issue of climate change. Very few people are likely to be in a position to assess the entire field objectively and accurately. The next best thing a person can do is to look at the conclusions of relevant and reliable authorities, such as the IPCC, and take their conclusions on trust.</p>
<p><strong>Examples of weak Appeals to Authority:</strong></p>
<ol>
<li>
<p>Homeopathy does work. After all, Prince Charles believes in it and uses it himself!</p>
</li>
<li>
<p>Smacking children is wrong and should be banned. The biologist professor Alice Bloggs has stated so.</p>
</li>
<li>
<p>Telepathy is real. I agree with Nobel Prize winning physicist professor Brian Josephson who said: "<em>there is a lot of evidence to support the existence of telepathy</em>"<sup>[1]</sup>.</p>
</li>
</ol>
<p>In the first example, Prince Charles may very well have a strong opinion on homeopathy. The fallacy with citing him, however, is that he\'s not a relevant authority on medical matters. It\'s only because of his esteemed position that his opinion is assumed to carry more weight. We have a tendency to listen to authority figures (<em>perceived</em> authorities) so this fallacious argument is put forward frequently. It is often used in advertising as the "celebrity endorsement" of a product.</p>
<p>In the second example, professor Bloggs is a biologist and not a child psychologist or relevant expert in the field. The fact that she is highly qualified in one area does not mean that she\'s therefore an expert in all areas.</p>
<p>In the third example, Josephson is a Nobel Prize winning physicist. As a physicist who studies the paranormal from a physicist\'s point of view, he may be deemed to be a relevant authority too. However, how many other physicists would agree with his conclusion? NOTE: it\'s his status as a Nobel Prize winning physicist that\'s the source of his authoritative status.</p>
<h3 class="subheading">Summary</h3>
<p>An Appeal to Authority is always fallacious. However, such arguments cannot always be dismissed because in many instances, an appeal to (a relevant, reliable) authority can be a good, reasonable argument &ndash; it\'s often the only position a non-expert can take.</p>
<p>The strength of an Appeal to Authority\'s support for a claim needs to be assessed. Fortunately there are criteria available which can help to decide whether the appeal is pertinent.</p>
<p><strong>References</strong></p>
<ol class="no_underline">
<li>
<p><a href="http://www.guardian.co.uk/uk/2001/sep/30/robinmckie.theobserver" target="_blank" rel="noopener">http://www.guardian.co.uk/uk/2001/sep/30/robinmckie.theobserver</a></p>
</li>
</ol>
<hr />
<p><strong>NOTE:</strong> There is a special case of the Appeal to Authority. This is in the instance of self-proclamation. Here the authority quoted is the person themselves (known as <em>ipse dixit</em>).</p>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => NULL,
                'publication_date' => '2021-05-13 09:20:00',
                'created_at' => '2020-05-17 12:34:50',
                'updated_at' => '2021-05-17 12:24:54',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'owner_id' => 1,
                'category_id' => NULL,
                'temporal_id' => 1,
                'type' => 1,
                'slug' => 'drinking-coffee-makes-you-see-ghosts',
                'meta_title' => 'Drinking coffee makes you see ghosts',
                'meta_description' => 'Does drinking coffee make you see ghosts?',
                'meta_keywords' => 'ghosts, coffee, caffeine',
                'title' => 'Drinking coffee makes you see ghosts',
                'subtitle' => NULL,
                'summary' => '<p>All over the media last week were reports of the finding that drinking coffee can lead to people seeing ghosts. Headlines such as:</p>
<ul>
<li><a href="http://www.telegraph.co.uk/scienceandtechnology/science/sciencenews/4227673/Three-cups-of-brewed-coffee-a-day-triples-risk-of-hallucinations.html" target="_blank" rel="noopener">Three cups of brewed coffee a day \'triples risk of hallucinations\'</a>;</li>
<li><a href="http://news.bbc.co.uk/1/hi/health/7827761.stm" target="_blank" rel="noopener">\'Visions link\' to coffee intake</a>; and the alarmist</li>
<li><a href="http://www.express.co.uk/posts/view/79820/Danger-from-just-7-cups-of-of-coffee-a-day" target="_blank" rel="noopener">Danger from just 7 cups of coffee a day.</a></li>
</ul>',
                'body' => '<p>All over the media last week were reports of the finding that drinking coffee can lead to people seeing ghosts. Headlines such as:</p>
<ul>
<li><a href="http://www.telegraph.co.uk/scienceandtechnology/science/sciencenews/4227673/Three-cups-of-brewed-coffee-a-day-triples-risk-of-hallucinations.html" target="_blank" rel="noopener">Three cups of brewed coffee a day \'triples risk of hallucinations\'</a>;</li>
<li><a href="http://news.bbc.co.uk/1/hi/health/7827761.stm" target="_blank" rel="noopener">\'Visions link\' to coffee intake</a>; and the alarmist</li>
<li><a href="http://www.express.co.uk/posts/view/79820/Danger-from-just-7-cups-of-of-coffee-a-day" target="_blank" rel="noopener">Danger from just 7 cups of coffee a day.</a></li>
</ul>
<!--more-->
<p>all had the same theme: that drinking coffee can lead to an increased risk of hallucination and therefore seeing ghosts or sensing dead people around you.</p>
<p>As is usually the case with the reporting of scientific publications, the story reported is often not actually what the research indicates and the headline writers usually extrapolate things so that they become sensationalist! That is certainly the case with this study.</p>
<h3 class="subheading">What was the study about?</h3>
<p>In what are called "Diathesis-stress models of psychosis", it is proposed that stress plays a role in the development of hallucinatory or schizophrenia-like experiences, which are enhanced by the stress hormone cortisol.</p>
<p>Caffeine has been found to increase the amount of cortisol released in response to stress and so it was proposed that ingestion of caffeine (not necessarily from coffee) would be associated with an increased proneness to psychotic-type experiences.</p>
<p>Previous studies in this area have used participants who have psychoses; however, there is a problem that any medication that they were on could interfere with caffeine. So in this study, the researchers used a \'normal\' population of participants as it\'s known that schizophrenia-like (or schizotypal) experiences occur in non-psychotic people too (the most common occurrence familiar to most people probably being hearing a voice in your ear).</p>
<p>What the researchers were looking for was to see whether:</p>
<ol type="1">
<li>Caffeine intake was associated with stress levels;</li>
<li>Caffeine intake was associated with hallucinatory experiences and/or persecutory ideation.</li>
</ol>
<h3 class="subheading">Results</h3>
<p>The results showed that caffeine consumption was not associated with persecutory ideation, but it was associated with stress and it was associated with hallucinatory experiences. The effect, the size of the association, was found to be small however.</p>
<p>Associations or correlations do not prove causation, and it may be that caffeine causes hallucinatory experiences in people but it may just be that people who have hallucinatory experiences consume more caffeine. Or, it could be something else altogether that causes people to have hallucinatory experiences <em>and</em> to consume more caffeine.</p>
<h3 class="subheading">What can we conclude?</h3>
<p>From a critical thinking point of view, we may be faced with people claiming that ghosts can be seen as the result of drinking coffee and such like; but this was really a huge extrapolation of the study\'s findings by the media headline writers and not a conclusion of the study - which, incidentally, had nothing to do with ghosts or the paranormal.</p>
<p>What we can say is that the study\'s findings support the hypothesis that caffeine consumption may have a small effect on psychosis-like hallucinatory experiences in people who are prone to stress and such experiences in the first place. The effect of caffeine on these experiences, if true, is so small that it probably has little or no meaning outside of a clinical setting.</p>
<p>This was a small, preliminary piece of research that was relevant to its own field, but it\'s not an answer to seeing ghosts, hearing voices and other, what we might come across as paranormal, experiences.</p>
<p>The problem here is not the actual research or the researchers, but the media\'s interpretation of it.</p>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => NULL,
                'publication_date' => '2008-05-17 00:00:00',
                'created_at' => '2020-05-17 12:46:26',
                'updated_at' => '2021-05-17 15:56:23',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'owner_id' => 3,
                'category_id' => NULL,
                'temporal_id' => 3,
                'type' => 1,
                'slug' => 'test-post',
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'title' => 'Test Post',
                'subtitle' => NULL,
                'summary' => '<p>Test post summary</p>',
                'body' => '<p>Test post body</p>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => 'boiron-homeopathy-tube.jpg',
                'publication_date' => '2021-05-15 12:00:00',
                'created_at' => '2021-05-15 16:49:01',
                'updated_at' => '2021-05-18 15:57:43',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'owner_id' => 1,
                'category_id' => NULL,
                'temporal_id' => NULL,
                'type' => 3,
                'slug' => 'index',
                'meta_title' => 'Critical Thinking UK',
                'meta_description' => 'Introductory critical thinking',
                'meta_keywords' => NULL,
                'title' => 'index',
                'subtitle' => NULL,
                'summary' => NULL,
            'body' => '<p>This is the (dynamic) home page.</p>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => NULL,
                'publication_date' => '2021-05-16 12:00:00',
                'created_at' => '2021-05-16 12:01:48',
                'updated_at' => '2021-05-16 12:01:48',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'owner_id' => 3,
                'category_id' => NULL,
                'temporal_id' => NULL,
                'type' => 3,
                'slug' => 'about-us',
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'title' => 'About us',
                'subtitle' => NULL,
                'summary' => NULL,
                'body' => '<p>About us</p>',
                'pdf' => NULL,
                'published' => 0,
                'sticky' => 0,
                'image' => NULL,
                'publication_date' => '2021-05-16 12:00:00',
                'created_at' => '2021-05-16 12:33:09',
                'updated_at' => '2021-05-17 12:25:34',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'owner_id' => 1,
                'category_id' => NULL,
                'temporal_id' => 3,
                'type' => 1,
                'slug' => 'news-story',
                'meta_title' => NULL,
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'title' => 'News story',
                'subtitle' => 'This is a news story',
                'summary' => '<p>A news story summary</p>',
                'body' => '<p>A news story content</p>',
                'pdf' => NULL,
                'published' => 1,
                'sticky' => 0,
                'image' => 'news.png',
                'publication_date' => '2021-05-17 12:00:00',
                'created_at' => '2021-05-17 16:04:59',
                'updated_at' => '2021-05-18 15:32:43',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}