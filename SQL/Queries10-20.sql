--10
SELECT privilege.privName, specialUser.username , users.fName, users.lName, country.cName, users.email, users.phone
FROM privilege, specialUser, users,country
WHERE users.privID = privilege.privID and users.cID = country.cID and users.uID = specialUser.uID
ORDER BY privilege.privName ASC, country.cName ASC;

--11
select sub.author, sub.majorT, sub.minorT, sub.dop, c.cName from (
select a.author, a.majorT, a.minorT, a.dop, u.cID
from article a
inner join users u on a.author = concat(u.fName, ' ', u.lName) union
select a.author, a.majorT, a.minorT, a.dop, orgC.cID
from article a
inner join (
select o.oName, goc.cID
from organization o
left join govOfCountry goc on o.oID = goc.oID
) as orgC on orgC.oName = a.author ) as sub, country c
where c.cID = sub.cID
order by cName asc, author asc, dop asc;

--12
select author, majorT, minorT, dop, cName, dateTimeOf from (
select a.aID, a.author, a.majorT, a.minorT, a.dop, u.cID, a.status from article a
inner join users u on a.author = concat(u.fName, ' ', u.lName) union
select a.aID, a.author, a.majorT, a.minorT, a.dop, orgC.cID, a.status from article a
inner join (
select o.oName, goc.cID
from organization o
left join govOfCountry goc on o.oID = goc.oID
) as orgC on orgC.oName = a.author
) as sub, country c, removalRecord rr
where sub.status = 'removed' AND rr.aID = sub.aID AND sub.cID = c.cID order by cName asc, dateTimeOF asc;

--13
SELECT privName, username, fName, lName, cName, email, phone, sr.dateTimeOf
FROM privilege, users, specialUser, country, suspensionRecord sr
WHERE users.privID = privilege.privID AND users.cID = country.cID AND specialUser.uID = users.uID AND users.status = "suspended" AND users.uID = sr.uID
order by dateTimeOf asc;

--14
--Depends on author inputted
SELECT majorT as "major topic", minorT as "minor topic", summary, articleContent, dop as "publication date"
FROM article
WHERE author = Author_Inputted_from_ui
ORDER BY dop ASC;

--15
select * from (
SELECT author, country.cName as "citizenship", count(article.aID) as "total number of publication"
FROM article, users, country
WHERE article.author = concat(users.fName, ' ',users.lName) AND country.cID = users.cID group by country.cName
union all
SELECT author, country.cName as "citizenship", count(article.aID) as "total number of publication"
FROM article, country, govOfCountry, organization
WHERE article.author = organization.oName AND organization.oID = govOfCountry.oID AND govOfCountry.cID = country.cID
) as a
ORDER BY 3 DESC;

--16
select * from
(
SELECT region.rName, country.cName, count(article.author) AS "total number of authors", count(article.aID) AS "total number of publication"
FROM article, users, country, region
WHERE article.author = concat(users.fName, ' ',users.lName) AND region.rID = country.rID AND country.cID = users.cID
GROUP BY region.rName, country.cName
union all
SELECT region.rName, country.cName, count(article.author) AS "total number of authors", count(article.aID) AS "total number of publication"
FROM organization, region, country, article, govOfCountry
WHERE article.author = organization.oName AND organization.oID = govOfCountry.oID AND region.rID = country.rID AND govOfCountry.cID = country.cID
) AS a
ORDER by 1 asc, 4 DESC;

--17
select region.rName as RegionName, CountryName, Population, TotalDead, TotalVaccinatedDead, TotalInfected, TotalVaccinatedInfected, TotalVaccinated from(
select c.cID, sum(pstr.dead) as TotalDead, sum(pstr.infected) as TotalInfected from pstRecord pstr, country c, proStaTer pst
where c.cID = pst.cID AND pst.pstID = pstr.pstID
group by c.cID
) as nonvaxx, (
select c.cID, sum(vaccinated) as TotalVaccinated, sum(vr.dead) as
TotalVaccinatedDead, sum(vr.infected) as TotalVaccinatedInfected from vacRecord vr, country c, proStaTer pst
where c.cID = pst.cID AND pst.pstID = vr.pstID
group by c.cID
) as vaxx, (
select c.cName as CountryName, c.cID, sum(pop) as Population from country c, proStaTer pst
where c.cID = pst.cID
group by c.cID
) as popcount, region, country
where nonvaxx.cID = vaxx.cID AND vaxx.cID=popcount.cID AND country.cID = popcount.cID AND country.rID = region.rID
order by TotalDead asc;

--18
--will depend on input from web
SELECT er.dateOf, er.email, er.subject
from emailRecord er
WHERE er.dateOf >= Lower_bound_input AND er.dateOf <= Upper_bound_input

--19
select sub2.cName as Country, sub2.sumpop as Population, sub.dateOf, coalesce(allVac, 0) as TotalVaccinated, TotalInfected, coalesce(VacInf, 0) as VaccinatedInfected, TotalDied, coalesce(VacDead, 0) as VaccinatedDead
from(
select coalesce(total.dateOf, vaxx.dateOf) as dateOf, allVac, coalesce(TotalInf, VacInf) as TotalInfected, VacInf, coalesce(TotalDead, VacDead) as TotalDied, VacDead
from (
select sum(infected) as TotalInf, sum(dead) as TotalDead, dateOf, cName, pop from pstRecord pr, country c, proStaTer pst
where c.cName = 'Canada' AND pst.cID = c.cId AND pr.pstID = pst.pstID group by dateOf
order by dateOf desc
) as total left join (
select sum(vaccinated) as allVac, sum(infected) as VacInf, sum(dead) as VacDead, dateOf, cName, pop
from vacRecord vr , country c, proStaTer pst
where c.cName = 'Canada' AND pst.cID = c.cId AND vr.pstID = pst.pstID group by dateOf
order by dateOf desc
) as vaxx on total.dateOf = vaxx.dateOf
UNION
select coalesce(total.dateOf, vaxx.dateOf) as dateOf, allVac, coalesce(TotalInf, VacInf)
as TotalInfected, VacInf, coalesce(TotalDead, VacDead) as TotalDied, VacDead from (
select sum(infected) as TotalInf, sum(dead) as TotalDead, dateOf, cName, pop from pstRecord pr, country c, proStaTer pst
where c.cName = 'Canada' AND pst.cID = c.cId AND pr.pstID = pst.pstID group by dateOf
order by dateOf desc ) as total
right join (
select sum(vaccinated) as allVac, sum(infected) as VacInf, sum(dead) as
VacDead, dateOf, cName, pop
from vacRecord vr , country c, proStaTer pst
where c.cName = 'Canada' AND pst.cID = c.cId AND vr.pstID = pst.pstID group by dateOf
order by dateOf desc
) as vaxx on total.dateOf = vaxx.dateOf ) as sub, (
select cName, sum(pop) as sumpop from country cty, proStaTer pst2
where cty.cName = 'Canada' AND pst2.cID=cty.cID
group by cName ) as sub2
order by dateOf desc;

--20
select fc.author, country.cName, fc.followersCount from(
select users.cID, followers.author, count(followers.author) as followersCount from followers, users
where followers.author = concat(users.fName, ' ', users.lName)
group by followers.author
union all
select govOfCountry.cID, orgFol.oName as author, orgFol.followersCount from(
select organization.oName, organization.oID, count(followers.author) as followersCount
from followers, organization
where followers.author=organization.oName group by followers.author
) as orgFol
left join govOfCountry on govOfCountry.oID = orgFol.oID ) as fc, country
where country.cID = fc.cID
having fc.followersCount = (select fc.followersCount from(
select users.cID, followers.author, count(followers.author) as followersCount from followers, users
where followers.author = concat(users.fName, ' ', users.lName)
group by followers.author
union all
select govOfCountry.cID, orgFol.oName as author, orgFol.followersCount from(
select organization.oName, organization.oID, count(followers.author) as followersCount
from followers, organization
where followers.author=organization.oName group by followers.author
) as orgFol
left join govOfCountry on govOfCountry.oID = orgFol.oID ) as fc, country
where country.cID = fc.cID
order by fc.followersCount desc limit 1) order by fc.followersCount desc;